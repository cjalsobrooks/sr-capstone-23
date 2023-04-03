<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'shirt_size',
        'age',
        'is_waiver_signed',
        'waiver_signed_by',
        'comment'
    ];
}
