<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sewage_discharge extends Model
{
    protected $table = 'sewage_discharge';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
