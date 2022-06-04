<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\general;

use App\Http\Controllers\Controller;
use App\Models\account\Account;
use App\Models\customer\Customer;
use App\Models\orderedSupply\OrderedSupply;
use App\Models\product\Product;
use App\Models\settings\SettingsRequiredFields;
use Illuminate\Http\Request;
use DB;

class SettingsController extends Controller
{

    public function all_settings(){
        $accounts = Account::all();

        return  view('focus.general.settings',compact('accounts'));
    }

    public function store_product_fields(Request $request){
        $data = $request->except('_token');

        SettingsRequiredFields::where('model_type',Product::class)->delete();

        foreach($data as $key => $item){
            \DB::table('settings_required_fields')->updateOrInsert([
                'model_type' => Product::class,
                'field' => $key,
                'is_require' => $item
            ]);
        }

        return redirect()->back();
    }

    public function store_customer_fields(Request $request){
        $data = $request->except('_token');

        SettingsRequiredFields::where('model_type',Customer::class)->delete();

        foreach($data as $key => $item){
            \DB::table('settings_required_fields')->updateOrInsert([
                'model_type' => Customer::class,
                'field' => $key,
                'is_require' => $item
            ]);
        }

        return redirect()->back();
    }

    public function store_orderedSupply_fields(Request $request){

        $data = $request->except('_token');

        SettingsRequiredFields::where('model_type',OrderedSupply::class)->delete();

        foreach($data as $key => $item){
            \DB::table('settings_required_fields')->updateOrInsert([
                'model_type' => OrderedSupply::class,
                'field' => $key,
                'is_require' => $item
            ]);
        }

        return redirect()->back();
    }

    public function store_account_fields(Request $request){

        $data = $request->except('_token');

        SettingsRequiredFields::where('model_type',Account::class)->delete();

        foreach(@$data['account_id'] as $key => $item){
            \DB::table('settings_required_fields')->updateOrInsert([
                'model_type' => Account::class,
                'field' => 'account_id',
                'is_require' => $item
            ]);
        }

        return redirect()->back();
    }

}
