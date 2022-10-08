<?php

namespace App\Http\Responses\Focus\branch;

use App\Models\Company\Company;
use App\Models\Company\ConfigMeta;
use App\Models\screen\Screen;
use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        $companies = Company::all();

        return view('focus.branches.create',compact('companies'));
    }
}
