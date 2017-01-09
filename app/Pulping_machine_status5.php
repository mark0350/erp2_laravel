<?php

namespace App;

use App\Http\Traits\ScopeModel;
use Illuminate\Database\Eloquent\Model;

class Pulping_machine_status5 extends Model
{
    use ScopeModel;
    protected $table = 'pulping_machine_status5';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
