<?php

namespace App\Livewire;

use App\Http\Requests\reservationRequest;
use App\Models\reservation;
use App\Models\Room;
use App\Services\reservationServices;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddReservation extends Component
{
    
    public $guestName;
    public $guestEmail;
    public $guestPhone;
    public $checkInDate;
    public $checkInTime;
    public $checkOutDate;
    public $numberOfGuests;


    public $user_id;
    public $currentMonth;
    public $currentYear;
    public $selectedRoom;
    public $selectedDate;
    public $rooms;
    public $reservations; // fetch from DB later
    public $errorMessage; // add this property

    protected reservationServices $reservationServices;

    public $roomReservations;

    public $roomPrice;
    public $reservationsPrice;

    public $stay_duration;
    public function updatedSelectedRoom($roomId)
    {
        
        $this->roomReservations = reservation::where('room_id', $roomId)
            ->orderBy('check_in_date', 'desc')
            ->get();
    }
    public function boot(reservationServices $reservationServices)
    {
        $this->reservationServices = $reservationServices;
    }

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $now = Carbon::now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;
        $this->rooms = Room::all();
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonthNoOverflow();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonthNoOverflow();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function getDaysProperty()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $daysInMonth = $startOfMonth->daysInMonth;
        $firstDayOfWeek = $startOfMonth->dayOfWeek; // 0 = Sunday

        $calendar = [];

        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $calendar[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $calendar[] = Carbon::create($this->currentYear, $this->currentMonth, $day);
        }

        return $calendar;
    }

    public function selectDate($day)
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, $day);
        $this->selectedDate = $date->format('Y-m-d');

        // Auto-populate check-in here
        $this->checkInDate = $this->selectedDate;

        // Auto-set check-out based on internal policy
        $this->checkOutDate = $date->copy()->addDay()->format('Y-m-d');
    }


    public function addReservation()
    {
        $request = new reservationRequest();

        $this->stay_duration = Carbon::parse($this->checkInDate)->diffInDays(Carbon::parse($this->checkOutDate));
        $this->roomPrice = Room::where('id',$this->selectedRoom)->value('roomPrice');
        $roomprice = $this->roomPrice;

        $this->reservationsPrice = floatval($roomprice) * $this->stay_duration;

       
        $request['user_id'] = $this->user_id;
        $request['selectedRoom'] = $this->selectedRoom;
        $request['reservationsPrice'] = $this->reservationsPrice;
        $request['stay_duration'] = $this->stay_duration;

        $validated = $this->validate($request->rules());
    
        try {
            $this->reservationServices->createReservation($validated);
            session()->flash('success', 'Reservation created successfully!');
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }


        $this->reset(['guestName','guestEmail','guestPhone','checkInDate','checkInTime','checkOutDate','numberOfGuests']);
    }

    public function render()
    {
        $this->reservations = reservation::with('room')->get()->where('room_id', $this->selectedRoom);
        return view('livewire.add-reservation', [
            'calendarDays' => $this->days,
        ]);
    }
}
