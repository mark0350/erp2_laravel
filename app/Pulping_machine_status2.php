<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pulping_machine_status2 extends Model
{
    protected $table = 'pulping_machine_status2';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
