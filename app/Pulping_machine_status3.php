<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pulping_machine_status3 extends Model
{
    protected $table = 'pulping_machine_status3';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
