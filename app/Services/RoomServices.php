<?php

namespace App\Services;

use App\Models\Room;
use App\Models\RoomImage;
use Exception;
use Illuminate\Support\Facades\DB;

class RoomServices
{
	public function createRoom(array $data)
	{
		// return DB::transaction(function()use($data){
		DB::beginTransaction();
		try {
			$room = Room::create([
				'roomName' => $data['roomName'],
				'roomDescription' => $data['roomDescription'],
				'roomNumber' => $data['roomNumber'],
				'roomPrice' => $data['roomRate'],
				'capacity' => $data['roomCapacity'],
			]);
			if (!empty($data['images'])) {
				foreach ($data['images'] as $image) {
					$path = $image->store('rooms', 'public');

					RoomImage::create([
						'room_id' => $room->id,
						'image_path' => $path,
					]);
				}
			}
			DB::commit();
			return $room;
		} catch (Exception $e) {

			DB::rollBack();
			throw $e;
		}

	}

	public function updateRoom(array $data)
	{
		DB::beginTransaction();
		try {
			$room = Room::findOrFail($data['id']);
			$room->update([
				'roomName' => $data['roomName'],
				'roomDescription' => $data['roomDescription'],
				'roomNumber' => $data['roomNumber'],
				'roomPrice' => $data['roomRate'],
				'capacity' => $data['roomCapacity'],
				'status' => $data['roomStatus']
			]);
			//for new images//
			if (!empty($data['images'])) {
				foreach ($data['images'] as $image) {
					$path = $image->store('rooms', 'public');

					RoomImage::create([
						'room_id' => $room->id,
						'image_path' => $path,
					]);
				}
			}
			DB::commit();
			return $room;
		} catch (Exception $e) {
			DB::rollBack();
			throw $e;
		}
	}

	public function DeleteOldImage(array $data)
	{
		DB::beginTransaction();
		try {
			if (!empty($data['oldImages'])) {
				foreach ($data['oldImages'] as $imageId) {
					RoomImage::where('id', $imageId)->delete();
				}
			}
			DB::commit();
		} catch (Exception $e) {
			DB::rollBack();
			throw $e;
		}
	}
}

