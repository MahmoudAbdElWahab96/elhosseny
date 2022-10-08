<?php

namespace App\Http\Responses\Focus\account;

use App\Models\account\Account;
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
        //  $account_types = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 17)->first('value1');
        //  $account_types=json_decode($account_types->value1,true);
        $account_types = Account::whereNull('parent_account_id')->whereNull('account_type')->where('level', 1)->pluck('holder', 'id');
        $account_level = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 21)->first('value2') ?
             json_decode(ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 21)->first('value2')->value2,true) : '';
        $parents_accounts = Account::all()->pluck('holder', 'id')->toArray();
        $screens = Screen::all()->pluck('name_ar', 'id')->toArray();
        $cost_centers = [];
        $level = optional(ConfigMeta::where('value1','cost_center_account_level')->first())->value2;

        return view('focus.accounts.create',compact('account_types', 'account_level', 'parents_accounts', 'screens', 'cost_centers', 'level'));
    }
}
