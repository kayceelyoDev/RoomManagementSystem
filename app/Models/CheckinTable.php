<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinTable extends Model
{
    //

    protected $fillable = [
        'user_id',
        'reservation_id',
        'paymentMethod',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function reservation()
    {
        return $this->belongsTo(reservation::class);
    }
}
