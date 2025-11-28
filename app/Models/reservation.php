<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    //
    protected $fillable = ['user_id', 'room_id', 'guest_name', 'guest_email', 'guest_phone', 'check_in_date','check_in_time', 'check_out_date', 'number_of_guests','stay_duration','price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
