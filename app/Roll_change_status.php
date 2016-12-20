<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll_change_status extends Model
{
    protected $table = 'roll_change_status';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
