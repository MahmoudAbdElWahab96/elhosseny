<?php

namespace App\Http\Responses\Focus\discount;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\additional\Additional
     */
    protected $additionals;

    /**
     * @param App\Models\additional\Additional $additionals
     */
    public function __construct($additionals)
    {
        $this->additionals = $additionals;
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
        return view('focus.discounts.edit')->with([
            'additionals' => $this->additionals
        ]);
    }
}
