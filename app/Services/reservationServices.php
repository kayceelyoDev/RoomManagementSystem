<?php

namespace App\Services;

use App\Models\reservation;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class reservationServices
{
    public function createReservation(array $data)
    {
        // Check if room is already reserved for the given time (excluding cancelled reservations)
        $isOccupied = Reservation::where('room_id', $data['selectedRoom'])
            ->where('status', '!=', 'cancelled') // <-- ignore cancelled reservations
            ->where(function ($query) use ($data) {
                $query->whereBetween('check_in_date', [$data['checkInDate'], $data['checkOutDate']])
                    ->orWhereBetween('check_out_date', [$data['checkInDate'], $data['checkOutDate']])
                    ->orWhere(function ($q) use ($data) {
                        $q->where('check_in_date', '<=', $data['checkInDate'])
                            ->where('check_out_date', '>=', $data['checkOutDate']);
                    });
            })
            ->exists();

        if ($isOccupied) {
            throw new Exception('The selected room is already occupied for these dates.');
        }


        DB::beginTransaction();
        try {
            $room = reservation::create([
                'user_id' => $data['user_id'],
                'room_id' => $data['selectedRoom'],
                'guest_name' => $data['guestName'],
                'guest_email' => $data['guestEmail'],
                'guest_phone' => $data['guestPhone'],
                'check_in_date' => $data['checkInDate'],
                'check_in_time' => $data['checkInTime'],
                'check_out_date' => $data['checkOutDate'],
                'stay_duration' => $data['stay_duration'],
                'number_of_guests' => $data['numberOfGuests'],
                'price' => $data['reservationsPrice'],
            ]);
            DB::commit();
            return $room;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function UpdateReservation(array $data){
        DB::beginTransaction();
            
        try {
            $reservation = reservation::findOrFail($data['reservationId']);
            
            $reservation->update([
                'user_id' => $data['user_id'],
                'guest_name' => $data['guest_name'],
                'guest_email' => $data['guest_email'],
                'guest_phone' => $data['guest_phone'],
                'check_in_date' => $data['check_in_date'],
                'check_in_time' => $data['check_in_time'],
                'check_out_date' => $data['check_out_date'],
                'stay_duration' => $data['stay_duration'],
                'number_of_guests' => $data['number_of_guests'],
                'price' => $data['reservationPrice'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            Db::rollBack();
            throw $e;

        }
    }
}
