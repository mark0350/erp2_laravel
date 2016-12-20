<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Water_consumption extends Model
{
    protected $table = 'water_consumption';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
