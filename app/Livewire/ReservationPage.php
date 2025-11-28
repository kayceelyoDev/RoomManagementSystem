<?php

namespace App\Livewire;

use App\Http\Requests\reservationRequest;
use App\Models\reservation;
use App\Models\Room;
use App\Services\reservationServices;
use Auth;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ReservationPage extends Component
{
    public $reservations;
    public $selectedReservation;
    public $isUpdateModalOpen;
    public $totalDays;
    public $days;

    public $stay_duration;
    public $reservationPrice;
    public $roomPrice;
    public $guest_name;
    public $guest_email;
    public $guest_phone;
    public $check_in_date;
    public $check_out_date;
    public $check_in_time;
    public $number_of_guests;
    public $status;

    public $user_id;


    protected reservationServices $reservationServices;

     public function boot(reservationServices $reservationServices)
    {
        $this->reservationServices = $reservationServices;
    }
    public function updateStatus($status)
    {
        $reservationStatus = reservation::findOrFail($this->selectedReservation);
        $reservationStatus->update([
            'status' => $status,
        ]);

        $this->selectedReservation = null;
    }

    public function editReservation($id)
    {
        $reservation = Reservation::find($id);

        // Populate the public properties that wire:model binds to
        $this->selectedReservation = $id;
        $this->guest_name = $reservation->guest_name;
        $this->guest_email = $reservation->guest_email;
        $this->guest_phone = $reservation->guest_phone;
        $this->number_of_guests = $reservation->number_of_guests;
        $this->check_in_date = $reservation->check_in_date;
        $this->check_in_time = $reservation->check_in_time;
        $this->check_out_date = $reservation->check_out_date;
        $this->status = $reservation->status;

        // Open the modal
        $this->isUpdateModalOpen = true;
    }

    public function updateReservation()
    {

        $request = new reservationRequest();
        //get Current Reservation///
        $currentReservation = reservation::with('room')->findOrFail($this->selectedReservation);

        //price logic//

        //get the days stay//
        $this->stay_duration = Carbon::parse($this->check_in_date)->diffInDays(Carbon::parse($this->check_out_date));

        //get room price//
        $this->roomPrice = $currentReservation->price;

        $this->reservationPrice = floatval($this->roomPrice) * $this->stay_duration;
        
        try {
            $validated = $this->validate($request->updateRules());
            session()->flash('success', 'Reservation created successfully!');
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
       

        $validated['reservationId'] = $this->selectedReservation;
        $validated['reservationPrice'] = $this->reservationPrice;

        $this->reservationServices->UpdateReservation($validated);

    }

    public function render()
    {
        $this->user_id = Auth::user()->id;


        $this->reservations = Reservation::with('room')
            ->orderBy('check_in_date', 'asc')
            ->orderBy('status', 'asc')
            ->get();

        return view('livewire.reservation-page');
    }
}
