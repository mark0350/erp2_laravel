<?php

namespace App\Http\Controllers;

use App\Http\Traits\InsertSignalData;

class AnalogController extends Controller
{
    use InsertSignalData;

    protected $rule;

    public function __construct()
    {
        // don't format this class since the rule:in should avoid space
        $this->rule = [
            'table_name' => 'required|in:Paper_machine_speed,Sizing_machine_width,Paper_substance,Paper_moisture,'.
                'Paper_thick,Water_consumption,Steam_consumption,Electricity_consumption,Sewage_discharge',
            'value' => 'required',
        ];
    }

}
