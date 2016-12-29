<?php

namespace App;

use App\Http\Traits\ScopeModel;
use Illuminate\Database\Eloquent\Model;

class Sizing_machine_status extends Model
{
    use ScopeModel;
    protected $table = 'roll_change_status';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;

    public static function lengthOfStatus($start_time, $end_time, $value)
    {
        $data = self::DataBetween($start_time, $end_time)->get();
        if (is_bool($data) || $data->isEmpty())
            return false;
        $data->first()->start_time <= $start_time ?: $data->first()->start_time = $start_time;
        $data->last()->end_time >= $end_time ?: $data->last()->end_time = $end_time;
        return $data->where('value',$value)->sum('duration');

    }


}
