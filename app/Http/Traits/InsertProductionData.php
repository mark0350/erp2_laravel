<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

trait InsertProductionData
{
    /**
     * Post /api/digital
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $validatedData = $this->getValidatedData($request->all());
        $result = \App\Paper_production::craete($validatedData);
        if($result)
            return 'success';
        return 'fail';

    }
}