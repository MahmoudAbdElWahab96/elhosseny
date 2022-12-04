<?php

namespace App\Http\Responses\Focus\productVariable;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\productVariable\ProductVariable
     */
    protected $productvariables;

    /**
     * @param App\Models\productVariable\ProductVariable $productVariables
     */
    public function __construct($productVariables)
    {
        $this->productVariables = $productVariables;
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
        return view('focus.productVariables.edit')->with([
            'productVariables' => $this->productVariables
        ]);
    }
}