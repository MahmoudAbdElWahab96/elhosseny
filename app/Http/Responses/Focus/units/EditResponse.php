<?php

namespace App\Http\Responses\Focus\units;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\unit\Unit
     */
    protected $units;

    /**
     * @param App\Models\unit\Unit $unit
     */
    public function __construct($units)
    {
        $this->units = $units;
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
        return view('focus.units.edit')->with([
            'units' => $this->units
        ]);
    }
}