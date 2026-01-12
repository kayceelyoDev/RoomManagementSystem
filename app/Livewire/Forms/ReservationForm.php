<?php

namespace App\Livewire\Forms;

use App\Http\Requests\reservationRequest;
use App\Models\Room;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReservationForm extends Form
{
    //
    public $guestName;
    public $guestEmail;
    public $guestPhone;
    public $checkInDate;
    public $checkInTime;
    public $checkOutDate;
    public $numberOfGuests;
    public $user_id;
    public $selectedRoom;
    public $reservationsPrice;
    public $stay_duration;
    public $roomPrice;

    public function rules(){
        return (new reservationRequest())->rules();
    }

    public function makeReservationForm(){
        $this->stay_duration = Carbon::parse($this->checkInDate)->diffInDays(Carbon::parse($this->checkOutDate));
        $this->roomPrice = Room::where('id',$this->selectedRoom)->value('roomPrice');
        $roomprice = $this->roomPrice;

        $this->reservationsPrice = floatval($roomprice) * $this->stay_duration;

        $this->validate();

        return $this->all();
    }

    public function updateReservation(){
        
    }
}
