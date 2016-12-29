<?php

namespace App;

use App\Http\Traits\ScopeModel;
use Illuminate\Database\Eloquent\Model;

class Sizing_machine_status extends Model
{
    use ScopeModel;
    protected $table = 'sizing_machine_status';
    protected $fillable = ['value', 'start_time', 'end_time', 'duration'];
    public $timestamps = false;

    public static function lengthOfStatus($start_time, $end_time, $value)
    {
        $data = self::DataBetween($start_time, $end_time)->get();
        if (is_bool($data) || $data->isEmpty())
            return false;
        if($data->first()->start_time <= $start_time){
            $data->first()->start_time = $start_time;
            $data->first()->duration = ($data->first()->end_time - $data->first()->start_time);
        }
        if($data->last()->end_time >= $end_time){
            $data->last()->end_time = $end_time;
            $data->last()->duration = ($data->last()->end_time - $data->last()->end_time);
        }
        return $data->where('value',$value)->sum('duration');

    }


}
