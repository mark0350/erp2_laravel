<?php


namespace App\Http\Traits;


trait ScopeModel
{
    public function scopeLatest($query, $start_time, $end_time)
    {
        return $query->where('start_time', '<', $end_time)->where('end_time','>', $start_time)->orderBy("end_time", "DESC")->orderBy("start_time"," DESC")->first();
    }
}