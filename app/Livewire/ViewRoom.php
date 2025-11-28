<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class ViewRoom extends Component
{   
    public $roomId;
    public $room;
    public $showModal = false;
    public $selectedImage = '';

    public function openModal($imagePath)
    {
        $this->selectedImage = $imagePath;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedImage = '';
    }

    public function mount(Room $room){
        $this->roomId=$room;
        $this->room = $room;
        $room->load('image');
    }

    public function render()
    {
        return view('livewire.view-room');
    }
}
