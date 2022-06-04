<?php

namespace App\Http\Responses\Focus\taxes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\tax\Tax
     */
    protected $taxes;

    /**
     * @param App\Models\tax\Tax $taxes
     */
    public function __construct($taxes)
    {
        $this->taxes = $taxes;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('focus.taxes.edit')->with([
            'taxes' => $this->taxes
        ]);
    }
}