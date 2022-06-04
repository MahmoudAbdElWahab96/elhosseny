<?php

namespace App\Http\Responses\Focus\additional;

use App\Models\tax\Tax;
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
        $taxs = Tax::all();

        return view('focus.additionals.create',compact('taxs'));
    }
}
