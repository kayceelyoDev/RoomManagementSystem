<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable =['roomName','roomDescription','roomNumber','roomPrice','capacity','status'];

    public function image(){
        return $this->hasMany(RoomImage::class);
    }
    public function reservation(){
        return $this->hasMany(Reservation::class);
    }
}
