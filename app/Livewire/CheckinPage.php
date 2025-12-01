<?php

namespace App\Livewire;

use Livewire\Component;

class CheckinPage extends Component
{   
    public $search = '';
    public $selectedReservation = null;
    public $showCheckInModal = false;

    // Payment Form Variables
    public $amountTendered = 0;
    public $paymentMethod = 'cash';
    public $addNote = '';

    // Mock Data for UI Visualization
    public $reservations = [
        [
            'id' => 101,
            'guest_name' => 'John Doe',
            'room_type' => 'Deluxe Suite',
            'room_number' => '305',
            'check_in' => '2023-10-25',
            'check_out' => '2023-10-28',
            'total_amount' => 150.00,
            'deposit' => 50.00,
            'status' => 'Pending',
            'is_room_ready' => true,
        ],
        [
            'id' => 102,
            'guest_name' => 'Sarah Smith',
            'room_type' => 'Standard Double',
            'room_number' => '204',
            'check_in' => '2023-10-25',
            'check_out' => '2023-10-26',
            'total_amount' => 85.00,
            'deposit' => 0.00,
            'status' => 'Confirmed',
            'is_room_ready' => false, // Room still being cleaned
        ],
        // Add more mock data here...
    ];

    public function selectReservation($id)
    {
        // In a real app, you would fetch from DB: Reservation::find($id)
        $this->selectedReservation = collect($this->reservations)->firstWhere('id', $id);
        $this->amountTendered = 0; // Reset payment
        $this->showCheckInModal = true;
    }

    public function closeCheckInModal()
    {
        $this->showCheckInModal = false;
        $this->selectedReservation = null;
    }

    public function processCheckIn()
    {
        // Add your Check-in logic here (DB updates, etc.)
        $this->closeCheckInModal();
        session()->flash('message', 'Guest checked in successfully!');
    }

    public function getBalanceProperty()
    {
        if (!$this->selectedReservation) return 0;
        return $this->selectedReservation['total_amount'] - $this->selectedReservation['deposit'];
    }

    public function getChangeProperty()
    {
        return max(0, (float)$this->amountTendered - $this->balance);
    }
    public function render()
    {
        return view('livewire.checkin-page');
    }
}
