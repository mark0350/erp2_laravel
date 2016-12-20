<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

trait InsertData
{
    /**
     * Post /api/digital
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $table_name = ucfirst(strtolower($request['table_name']));
        $validator = $this->validator(array('value' => $request['value'], 'table_name' => $table_name));
        if ($validator->fails()) {
            return Response::make(['message' => '数据验证失败', 'errors' => $validator->errors()]);
        }
        $nameSpace = '\\App\\' . $table_name;
        $arr = ['value' => $request['value'], 'start_time' => time(), 'end_time' => time(), 'duration' => 0];
        $last = $nameSpace::orderBy('id', 'desc')->first();
        $last->end_time = $arr['start_time'];
        $last->duration = $last->end_time - $last->start_time;
        if ($last->value != $arr['value']) {
            $result = $nameSpace::create($arr);
            if (!$result)
                return 'fail';
        }
        if ($last->save())
            return 'success';
        else
            return 'false';


    }
}