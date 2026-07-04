<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Garage;
use App\Models\Booking;

class Service extends Model
{
    protected $fillable = ['garage_id', 'service_name', 'price'];

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
