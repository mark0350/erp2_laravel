<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_thick extends Model
{
    protected $table = 'paper_thick';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
