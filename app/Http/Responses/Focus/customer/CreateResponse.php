<?php

namespace App\Http\Responses\Focus\customer;

use App\Models\country\Country;
use App\Models\customer\Customer;
use App\Models\customergroup\Customergroup;
use App\Models\customfield\Customfield;
use App\Models\settings\SettingsRequiredFields;
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
        $input = $request->only('rel_type', 'rel_id');
        $customergroups=Customergroup::all();
        $countries = Country::all(['id', 'Desc_' . app()->getLocale() ]);
        $customer='';
         if(isset($input['rel_id']))$customer=Customer::find($input['rel_id']);
          $fields=custom_fields(Customfield::where('module_id', '1')->get()->groupBy('field_type'));

        $customer_name = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'name')->select(['is_require'])->first();
        $customer_phone = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'phone')->select(['is_require'])->first();
        $customer_email = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'email')->select(['is_require'])->first();

        return view('focus.customers.create',compact('customer_name','customer_phone','customer_email','customergroups','fields','input','customer', 'countries'));

    }
}
