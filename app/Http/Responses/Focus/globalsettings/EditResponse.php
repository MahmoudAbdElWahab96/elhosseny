<?php

namespace App\Http\Responses\Focus\subtaxes;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\subtax\SubTax
     */
    protected $taxes;

    /**
     * @param App\Models\subtax\SubTax $subtax
     */
    public function __construct($subtax)
    {
        $this->subtaxes = $subtax;
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
        return view('focus.subtaxes.edit')->with([
            'subtaxes' => $this->subtaxes
        ]);
    }
}