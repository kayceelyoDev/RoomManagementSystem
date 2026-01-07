<?php

namespace App\Livewire;

use App\Models\reservation;
use Livewire\Component;

class CheckinPage extends Component
{
    public $search = '';
    public $selectedReservation = null;
    public $showCheckInModal = false;

    // Payment Form Variables
    public $amountTendered;
    public $paymentMethod = 'cash';
    public $addNote = '';

    public function selectReservation($id)
    {
        $this->selectedReservation = reservation::with('room')->find($id);
        $this->amountTendered; // Reset payment
        $this->showCheckInModal = true;
    }

    public function closeCheckInModal()
    {
        $this->showCheckInModal = false;
        $this->selectedReservation = null;
    }

    public function createCheckin()
    {


        $this->closeCheckInModal();
        session()->flash('message', 'Guest checked in successfully!');
    }

    public function getBalanceProperty()
    {
        if (!$this->selectedReservation) return 0;

        return $this->selectedReservation->price;
    }

    public function getChangeProperty()
    {
        return max(0, (float)$this->amountTendered - $this->balance);
    }

    public function render()
    {
        $reservations = reservation::with('room')
            ->whereIn('status', [reservation::STATUS_CONFIRMED, reservation::STATUS_PENDING])
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
