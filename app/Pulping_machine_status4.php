<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pulping_machine_status4 extends Model
{
    protected $table = 'pulping_machine_status4';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
