<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_moisture extends Model
{
    protected $table = 'paper_moisture';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
