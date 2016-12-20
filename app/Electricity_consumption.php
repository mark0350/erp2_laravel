<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Electricity_consumption extends Model
{
    protected $table = 'electricity_consumption';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
