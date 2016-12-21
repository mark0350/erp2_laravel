<?php

namespace App\Http\Controllers;

use\App\Http\Traits\InsertProductionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductionController extends Controller
{
    use InsertProductionData;

    protected function getValidatedData(array $data)
    {
        // don't format this class since the rule:in should avoid space
        $validator = Validator::make($data, [
            'OnlyID' => 'required',
            'Basisweight' => 'required',
        ]);
        if ($validator->fails()) {
            exit(Response::make(['message' => '数据验证失败', 'errors' => $validator->errors()]));
        }
        return $data;
    }
}
