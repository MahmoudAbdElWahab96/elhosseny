<?php

namespace App\Http\Responses\Focus\openingBalance;

use App\Models\OpeningBalance\OpeningBalance;
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
        $level = ConfigMeta::where('value1','cost_center_account_level')->first()->value2;
        $openingBalance = OpeningBalance::where('level', $level)->get();
        
        return view('focus.openingBalance.create',compact('openingBalance', 'level'));
    }
}