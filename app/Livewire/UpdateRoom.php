<?php

namespace App\Livewire;

use App\Http\Requests\RoomRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Room;
use App\Models\RoomImage;
use App\Services\RoomServices;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateRoom extends Component
{
    use WithFileUploads;
    protected RoomServices $roomservices;


    public $roomId;
    public $room;
    public $images;
    public $oldImages;
    public $newImages;

    public $roomName;
    public $roomNumber;
    public $roomRate;
    public $roomCapacity;
    public $roomDescription;

    // For existing images - remove from current view
    public function removeExistingImage($imageId)
    {
        $this->images = $this->images->filter(function ($image) use ($imageId) {
            return $image->id !== $imageId;
        });

        $this->oldImages[] = $imageId;
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

    public function boot(RoomServices $roomservices)
    {
        $this->roomservices = $roomservices;
    }
    public function mount(Room $room)
    {
        $this->room = $room;
        $this->roomId = $room->id;
        $this->roomName = $room->roomName;
        $this->roomNumber = $room->roomNumber;
        $this->roomCapacity = $room->capacity;
        $this->roomRate = $room->roomPrice;
        $this->roomDescription = $room->roomDescription;
        $this->images = $room->image; 
    }

    public function roomUpdate()
    {
        $request = new RoomUpdateRequest();

        $validated = $this->validate($request->rules());

        $validated['id'] = $this->roomId;

        $validated['images'] = $this->newImages ?? [];
        
        $this->roomservices->updateRoom($validated);

        if (!empty($this->oldImages)) {
            $this->roomservices->DeleteOldImage([
                'id' => $this->roomId,
                'oldImages' => $this->oldImages
            ]);
        }

        return redirect()->route('roompage');
    }
    public function render()
    {

        return view('livewire.update-room');
    }
}
