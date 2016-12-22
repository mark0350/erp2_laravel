<?php

namespace App\Http\Controllers;

use App\Http\Traits\InsertSignalData;

class DigitalController extends Controller
{
    use InsertSignalData;

    protected $rule;

    public function __construct()
    {
        // don't format this class since the rule:in should avoid space
        $this->rule = [
            'table_name' => 'required|in:Paper_machine_status,Pulping_machine_status1,Pulping_machine_status2,Pulping_machine_status3,'.
                'Pulping_machine_status4,Pulping_machine_status5,Roll_change_status,Sizing_machine_status,Reeling_machine_status',
            'value' => 'required|in:0,1',
        ];
    }


}
