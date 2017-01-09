<?php

namespace App;

use App\Http\Traits\Consumption;
use App\Http\Traits\ScopeModel;
use Illuminate\Database\Eloquent\Model;

class Electricity_consumption extends Model
{
    use Consumption, ScopeModel;
    protected $table = 'electricity_consumption';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
