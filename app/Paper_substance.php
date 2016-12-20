<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_substance extends Model
{
    protected $table = 'paper_substance';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
