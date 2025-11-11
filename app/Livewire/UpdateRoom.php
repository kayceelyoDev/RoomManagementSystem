<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\RoomImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateRoom extends Component
{
    use WithFileUploads;
    public $roomId;
    public $room;

    public $images;
    public $newImages = [];

    // For existing images - remove from current view
    public function removeExistingImage($imageId)
    {
        $this->images = $this->images->filter(function ($image) use ($imageId) {
            return $image->id !== $imageId;
        });
    }

    // For new uploaded images - remove from upload array
    public function removeNewImage($index)
    {
        array_splice($this->newImages, $index, 1);
    }

    // Keep your old method for compatibility
    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function mount($room)
    {
        $this->roomId = $room;

        $this->room = Room::with
        ('image')->findOrFail($room);

        $this->images = $this->room->image;
    }
    public function render()
    {

        return view('livewire.update-room');
    }
}
