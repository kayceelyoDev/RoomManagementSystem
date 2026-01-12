<?php

namespace App\Livewire;

use App\Models\Checkin;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CheckinPage extends Component
{
    public $search = '';
    public $selectedReservation = null;
    public $showCheckInModal = false;

    // Payment Form Variables
    public $amountTendered = 0;
    public $paymentMethod = 'Cash';
    public $paymentReference = '';
    public $remarks = '';

    // Reset and Open Modal
    public function selectReservation($id)
    {
        // Find reservation or fail gracefully
        $this->selectedReservation = Reservation::with('room')->find($id);

        if (!$this->selectedReservation) {
            return;
        }

        // Reset inputs
        $this->amountTendered = 0;
        $this->paymentMethod = 'Cash';
        $this->paymentReference = '';
        $this->remarks = '';

        $this->showCheckInModal = true;
    }

    public function closeCheckInModal()
    {
        $this->showCheckInModal = false;
        $this->selectedReservation = null;
        $this->reset(['amountTendered', 'paymentMethod', 'paymentReference', 'remarks']);
    }

    public function createCheckin()
    {
        // 1. Validation (Input Data)
        $this->validate([
            'paymentMethod' => 'required|in:Cash,Gcash,Bank,Credit',
            'amountTendered' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    // Use strict comparison for amounts
                    if ($this->paymentMethod === 'Cash' && bccomp($value, $this->selectedReservation->price, 2) === -1) {
                        $fail('Amount tendered is insufficient.');
                    }
                },
            ],
            'paymentReference' => 'required_unless:paymentMethod,Cash',
        ]);

        try {
            DB::transaction(function () {
                // 2. Security: Refresh & Lock the Record
                // We re-fetch the reservation using 'lockForUpdate()'.
                // This prevents another staff member from modifying this exact reservation
                // while this transaction is running.
                $reservation = Reservation::where('id', $this->selectedReservation->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // 3. Business Logic Security
                // Ensure the reservation is actually in a state that allows check-in.
                // Prevents checking in a guest who already cancelled 2 seconds ago.
                if (!in_array($reservation->status, ['Confirmed', 'Pending'])) {
                    throw ValidationException::withMessages([
                        'status' => 'This reservation status is ' . $reservation->status . ' and cannot be checked in.'
                    ]);
                }

                // 4. Create Checkin Record
                Checkin::create([
                    'reservation_id' => $reservation->id,
                    'processed_by' => auth()->id(),
                    'amount_paid' => $reservation->price,
                    'payment_method' => $this->paymentMethod,
                    'payment_reference_number' => $this->paymentMethod === 'Cash' ? null : $this->paymentReference,
                    'remarks' => $this->remarks,
                ]);

                // 5. Update Reservation Status
                $reservation->update([
                    'status' => 'Check In' // Consider using a constant: Reservation::STATUS_CHECKED_IN
                ]);

                // 6. Update Room Status
                // We use the relationship on the *locked* reservation instance
                if ($reservation->room) {
                    $reservation->room()->update([
                        'status' => 'Occupied'
                    ]);
                }
            });

          
            $this->closeCheckInModal();
            session()->flash('message', 'Guest checked in successfully!');

        } catch (\Exception $e) {
         
            if ($e instanceof ValidationException) {
                throw $e;
            }

          
            session()->flash('error', 'Check-in failed: ' . $e->getMessage());
        }
    }

    public function getBalanceProperty()
    {
        return $this->selectedReservation ? $this->selectedReservation->price : 0;
    }

    public function getChangeProperty()
    {
        return max(0, (float) $this->amountTendered - $this->balance);
    }


    public function render()
    {
        $reservations = Reservation::with('room')
            // CRITICAL FIX: Only get reservations that actually have a room
            ->whereHas('room')
            ->whereIn('status', ['Confirmed', 'Pending'])
            ->where(function ($query) {
                $query->where('guest_name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.checkin-page', [
            'reservations' => $reservations
        ]);
    }
}