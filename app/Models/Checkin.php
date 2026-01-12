<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'processed_by',
        'amount_paid',
        'payment_method',
        'payment_reference_number',
        'remarks',
    ];

    /**
     * Get the reservation associated with the check-in.
     */
    public function reservation()
    {
        return $this->belongsTo(reservation::class);
    }

    /**
     * Get the staff member (User) who processed the check-in.
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // /**
    //  * Optional: Helper to get the room directly through the reservation.
    //  */
    // public function room()
    // {
    //     return $this->hasOneThrough(Room::class, Reservation::class, 'id', 'id', 'reservation_id', 'room_id');
    // }
}