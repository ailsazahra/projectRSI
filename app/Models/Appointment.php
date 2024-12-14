<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_name',
        'expertise',
        'date',
        'time_start',
        'time_end',
        'quota',
        'booked',
    ];
}