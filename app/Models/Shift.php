<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'location_id',
        'name',
        'description',
        'start_time',
        'end_time',
        'max_volunteers',
        'current_volunteers',
        'is_accepting'
    ];
}
