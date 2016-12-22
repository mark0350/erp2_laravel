<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait InsertProductionData
{
    use ValidateParameter;

    /**
     * Post /api/digital
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $this->validateParameter($request->all(), $this->rule);
        $result = \App\Paper_production::create($request->all());
        if($result)
            return 'success';
        return 'fail';

    }
}