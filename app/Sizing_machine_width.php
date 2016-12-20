<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sizing_machine_width extends Model
{
    protected $table = 'sizing_machine_width';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
