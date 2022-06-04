<?php

namespace App\Http\Responses\Focus\orderedSupply;


use App\Models\account\Account;
use App\Models\customer\Customer;
use App\Models\customfield\Customfield;
use App\Models\items\CustomEntry;

use App\Models\market\ChannelBill;
use App\Models\market\SalesChannel;
use App\Models\orderedSupply\OrderedSupply;
use App\Models\settings\SettingsRequiredFields;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\orderedSupply\OrderedSupply
     */
    protected $orderedSupply;

    /**
     * @param App\Models\orderedSupply\OrderedSupply $orderedSupply
     */
    public function __construct($orderedSupply)
    {
        $this->orderedSupply = $orderedSupply;
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

        $fields = Customfield::where('module_id', '=', 2)->get()->groupBy('field_type');
        $fields_raw = array();

        if (isset($fields['text'])) {
            foreach ($fields['text'] as $row) {
                $data = CustomEntry::where('custom_field_id', '=', $row['id'])->where('module', '=', 2)->where('rid', '=', $this->orderedSupply->id)->first();
                $fields_raw['text'][] = array('id' => $row['id'], 'name' => $row['name'], 'default_data' => @$data['data']);
            }
        }
        if (isset($fields['number'])) {
            foreach ($fields['number'] as $row) {
                $data = CustomEntry::where('custom_field_id', '=', $row['id'])->where('module', '=', 2)->where('rid', '=', $this->orderedSupply->id)->first();
                $fields_raw['number'][] = array('id' => $row['id'], 'name' => $row['name'], 'default_data' => @$data['data']);
            }
        }

        $fields_data = custom_fields($fields_raw);
        $customer_name = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'name')->select(['is_require'])->first();
        $customer_phone = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'phone')->select(['is_require'])->first();
        $customer_email = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'email')->select(['is_require'])->first();

        if ($this->orderedSupply->i_class == 1) {

               $input = $request->only(['sub', 'p']);
            $customer = Customer::first();
            $accounts = Account::all();

            $input['sub'] = false;
            $last_orderedSupply = OrderedSupply::orderBy('id', 'desc')->where('i_class', '=', 1)->first();
                $action=route('biller.orderedSupply.pos_update',$this->orderedSupply->id);

            return view('focus.orderedSupply.pos.edit')->with(array('customer_name' => $customer_name,'customer_phone' => $customer_phone,'customer_email' => $customer_email,'last_orderedSupply' => $last_orderedSupply, 'sub' => $input['sub'], 'p' => $request->p, 'accounts' => $accounts, 'customer' => $customer,'orderedSupply' => $this->orderedSupply,'action'=>$action))->with(bill_helper(1, 2))->with(product_helper());

                //return view('focus.orderedSupply.pos.edit')->with(['orderedSupply' => $this->orderedSupply])->with(bill_helper(1))->with(compact('fields_data', 'sub'));

        } else {
            if ($this->orderedSupply->i_class == 0) {
                $sub['prefix'] = prefix(1);
            } else if ($this->orderedSupply->i_class > 1) {
                $sub['prefix'] = prefix(6);
            }

            $salesChannels=SalesChannel::all();
            $current_salesChannel=ChannelBill::where('bill_id','=',$this->orderedSupply->id)->where('ref','=',1)->first();

            return view('focus.orderedSupply.edit')->with(['customer_name' => $customer_name,'customer_phone' => $customer_phone,'customer_email' => $customer_email,'orderedSupply' => $this->orderedSupply])->with(bill_helper(1))->with(compact('fields_data', 'sub','salesChannels','current_salesChannel'));
        }
    }
}
