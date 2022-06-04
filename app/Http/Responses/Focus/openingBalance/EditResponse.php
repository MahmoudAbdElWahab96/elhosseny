<?php

namespace App\Http\Responses\Focus\account;

use App\Models\account\Account;
use App\Models\Company\ConfigMeta;
use App\Models\screen\Screen;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\account\Account
     */
    protected $accounts;

    /**
     * @param App\Models\account\Account $accounts
     */
    public function __construct($accounts)
    {
        $this->accounts = $accounts;
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
        // $account_types = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 17)->first('value1');
        // $account_types = json_decode($account_types->value1, true);
        $account_types = Account::whereNull('parent_account_id')->whereNull('account_type')->where('level', 1)->pluck('holder', 'id');

        $cost_centers_ids =  $this->accounts->cost_center_screens ? json_decode($this->accounts->cost_center_screens, true) : [];
        $cost_centers_screens = $this->accounts->screen;
        $parents_accounts = Account::all()->pluck('holder', 'id')->toArray();
        $screens = Screen::all()->pluck('name_ar', 'id')->toArray();
        $account_level = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 21)->first('value2') ?
            json_decode(ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 21)->first('value2')->value2,true) : '';
        $level = ConfigMeta::where('value1','cost_center_account_level')->first()->value2;

        return view('focus.accounts.edit')->with([
            'accounts' => $this->accounts,
            'account_types' => $account_types,
            'parents_accounts' => $parents_accounts ,
            'screens' => $screens,
            'account_level' => $account_level,
            'level' => $level,
            'cost_centers' => $cost_centers_screens
        ]);
    }
}