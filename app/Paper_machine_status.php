<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_machine_status extends Model
{
    protected $table = 'paper_machine_status';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
