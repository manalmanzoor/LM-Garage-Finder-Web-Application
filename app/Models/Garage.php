<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class Garage extends Model
{
   protected $fillable = [
        'user_id',
        'name',
        'location',
        'description',
        'image' // ✅ THIS MUST BE HERE
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
