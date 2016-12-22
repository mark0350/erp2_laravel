<?php

namespace App\Http\Controllers;

use\App\Http\Traits\InsertProductionData;


class ProductionController extends Controller
{
    use InsertProductionData;

    protected $rule;

    public function __construct()
    {
        // don't format this class since the rule:in should avoid space
        $this->rule = [
            'OnlyID' => 'required'|'unique',
        ];
    }


}
