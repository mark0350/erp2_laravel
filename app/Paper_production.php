<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paper_production extends Model
{
    protected $table = 'paper_production';
    protected $fillable = ['OnlyID', 'Basisweight', 'Width', 'Weight_Net','Grade_Print','Type_Print','Shift_Print', 'Color_Print', 'Date_P'];
    public $timestamps =false;

    public function scopeProductionBetween($query, $start_time, $end_time){
        return $query->select('Type_Print','Grade_Print',DB::raw('SUM(Weight_Net) AS Weight'))->whereBetween(DB::raw("STR_TO_DATE(`Date_P`, '%Y-%m-%d %H:%i:%s')"),[$start_time,$end_time])->groupBy('Type_Print','Grade_Print')
            ->get('Type_Print','Grade_Print', 'Weight_Net');
    }


}
