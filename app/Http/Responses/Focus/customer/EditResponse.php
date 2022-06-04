<?php

namespace App\Http\Responses\Focus\customer;

use App\Models\country\Country;
use App\Models\customer\Customer;
use App\Models\customergroup\Customergroup;
use App\Models\customergroup\CustomerGroupEntry;
use App\Models\customfield\Customfield;
use App\Models\items\CustomEntry;
use App\Models\settings\SettingsRequiredFields;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\customer\Customer
     */
    protected $customers;

    /**
     * @param App\Models\customer\Customer $customers
     */
    public function __construct($customers)
    {
        $this->customers = $customers;
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
        $customergroups = Customergroup::all();
        $countries = Country::all(['id', 'Desc_' . app()->getLocale()]);

        $current_group = CustomerGroupEntry::where('customer_id', '=', $this->customers->id)->get();
        $fields = Customfield::where('module_id', '=', '1')->get()->groupBy('field_type');
        $fields_raw = array();

        if (isset($fields['text'])) {
            foreach ($fields['text'] as $row) {
                $data = CustomEntry::where('custom_field_id', '=', $row['id'])->where('module', '=', 1)->where('rid', '=', $this->customers->id)->first();
                $fields_raw['text'][] = array('id' => $row['id'], 'name' => $row['name'], 'default_data' => $data['data']);
            }
        }
        if (isset($fields['number'])) {
            foreach ($fields['number'] as $row) {
                $data = CustomEntry::where('custom_field_id', '=', $row['id'])->where('module', '=', 1)->where('rid', '=', $this->customers->id)->first();
                $fields_raw['number'][] = array('id' => $row['id'], 'name' => $row['name'], 'default_data' => $data['data']);
            }
        }

        $fields = custom_fields($fields_raw);

        $customer_name = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'name')->select(['is_require'])->first();
        $customer_phone = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'phone')->select(['is_require'])->first();
        $customer_email = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'email')->select(['is_require'])->first();

        return view('focus.customers.edit')->with([
            'customer_name' => $customer_name,'customer_phone' => $customer_phone,'customer_email' => $customer_email,
            'customers' => $this->customers, 'customergroups' => $customergroups,
            'fields' => $fields, 'current_groups' => $current_group, 'countries' => $countries
        ]);
    }
}
