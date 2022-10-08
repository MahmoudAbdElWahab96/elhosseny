<?php

namespace App\Http\Responses\Focus\branch;

use App\Models\Company\Company;
use App\Models\Company\ConfigMeta;
use App\Models\screen\Screen;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\branch\Branch
     */
    protected $branches;

    /**
     * @param App\Models\branch\Branch $branchs
     */
    public function __construct($branches)
    {
        $this->branches = $branches;
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
        $companies = Company::all();

        return view('focus.branches.edit')->with([
            'companies' => $companies,
            'branches' => $this->branches
        ]);
    }
}
