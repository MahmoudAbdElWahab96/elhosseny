<?php

namespace App\Http\Responses\Focus\screens;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\screen\Screen
     */
    protected $screens;

    /**
     * @param App\Models\screen\Screen $screens
     */
    public function __construct($screens)
    {
        $this->screens = $screens;
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
        return view('focus.screens.edit')->with([
            'screens' => $this->screens
        ]);
    }
}