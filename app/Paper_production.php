<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_production extends Model
{
    protected $table = 'paper_production';
    protected $fillable = ['OnlyID', 'Basisweight', 'Width', 'Weight_Net','Grade_Print','Type_Print','Shift_Print', 'Color_Print', 'Date_P'];
}
