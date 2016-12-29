<?php

namespace App;

use App\Http\Traits\ScopeModel;
use Illuminate\Database\Eloquent\Model;

class Paper_thick extends Model
{
    use ScopeModel;
    protected $table = 'paper_thick';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;
}
