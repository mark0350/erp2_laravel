<?php

namespace App\Http\Traits;


use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

trait ValidateParameter
{

    protected function validateParameter(array $data, array $rule)
    {
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            Response::make(['message' => '数据验证失败', 'errors' => $validator->errors()])->throwResponse();
        }
    }
}