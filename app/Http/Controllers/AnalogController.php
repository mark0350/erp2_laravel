<?php

namespace App\Http\Controllers;

use App\Http\Traits\InsertData;
use Illuminate\Support\Facades\Validator;

class AnalogController extends Controller
{
    use InsertData;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // don't format this class since the rule:in should avoid space
        return Validator::make($data, [
            'table_name' => 'required|in:Paper_machine_speed,Sizing_machine_width,Paper_substance,Paper_moisture,'.
                'Paper_thick,Water_consumption,Steam_consumption,Electricity_consumption,Sewage_discharge',
            'value' => 'required',
        ]);
    }
}
