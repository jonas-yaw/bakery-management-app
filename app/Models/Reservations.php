<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservations extends Model
{
    Use SoftDeletes;
    protected $table = 'tabReservation_Room_Reservation';

    public $timestamps = false;

    protected $casts = [
        'from_date' => 'datetime:Y-m-d',
        'to_date' => 'datetime:Y-m-d',
    ];
}
