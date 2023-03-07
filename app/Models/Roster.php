<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompositePrimaryKeyTrait;

class Roster extends Model
{
    
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $primaryKey = array('volunteer_id', 'shift_id');
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'volunteer_id',
        'shift_id',
        'is_valid'
    ];
}
