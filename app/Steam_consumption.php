<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steam_consumption extends Model
{
    protected $table = 'steam_consumption';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
