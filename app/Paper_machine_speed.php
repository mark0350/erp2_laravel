<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_machine_speed extends Model
{
    protected $table = 'paper_machine_speed';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
