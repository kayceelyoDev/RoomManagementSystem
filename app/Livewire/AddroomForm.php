<?php

namespace App\Livewire;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use App\Services\RoomServices;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddroomForm extends Component
{
    use WithFileUploads;

    public $rooms;
    public $images = [];
    public $roomName;
    public $roomNumber;
    public $roomRate;
    public $roomCapacity;
    public $roomDescription;

    protected RoomServices $roomservices;
    public function boot(RoomServices $roomservices)
    {
        $this->roomservices = $roomservices;
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function addroom()
    {
        $request = new RoomRequest();

        $validated = $this->validate(
            $request->rules(),
        );

        $this->roomservices->createRoom($validated);

        $this->reset(['roomName', 'roomNumber', 'roomRate', 'roomCapacity', 'roomDescription', 'images']);

         return redirect()->route('roompage');

    }

    public function render()
    {   
   
       
        return view('livewire.addroom-form');
    }
}
