<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomPage extends Component
{
    public $rooms;

    public function deleteRoom($roomId){
        $room = Room::findOrFail($roomId);
        $room->delete();
    }

    public function render()
    {
         $this->rooms = Room::get(['id','roomName','roomNumber','status']);
        return view('livewire.room-page');
    }
}
