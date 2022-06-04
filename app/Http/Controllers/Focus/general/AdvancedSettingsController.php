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

use App\Http\Requests\Request;
use App\Http\Responses\RedirectResponse;
use App\Repositories\Focus\general\CompanyRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Http\Responses\ViewResponse;
use Illuminate\Support\Facades\File;
use DB;

class AdvancedSettingsController extends Controller
{
    public function edit()
    {
        return view('focus.general.advanced_settings.edit');
    }



    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'gs_code' => 'required',
            'egs_code' => 'required',
        ]);
        //Input received from the request
        $data = $request->all();
       $setting = [];
        //return with successfull message
        if ($result) return new RedirectResponse(route('biller.general.edit', [$setting->id]), ['flash_success' => trans('alerts.backend.settings.updated')]);
        return new RedirectResponse(route('biller.customers.show', [$setting->id]), '');

    }


}
