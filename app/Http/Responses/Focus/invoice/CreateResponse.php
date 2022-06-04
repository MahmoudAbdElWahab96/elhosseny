<?php

namespace App\Http\Responses\Focus\invoice;

use App\Models\customer\Customer;
use App\Models\hrm\Hrm;
use App\Models\invoice\Invoice;
use App\Models\market\SalesChannel;
use App\Models\orderedSupply\OrderedSupply;
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
        $input = $request->only(['sub','p']);
        if (isset($input['sub'])) {
            $last_invoice = Invoice::orderBy('id', 'desc')->where('i_class', '>', 1)->first();
        } else {
            $input['sub']=false;
            $last_invoice = Invoice::orderBy('id', 'desc')->where('i_class', '=', 0)->first();
        }
        $employee='';
        $salesChannel=SalesChannel::all();

        if(feature(1)['value1']=='yes') $employee=Hrm::all();
        $customer_name = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'name')->select(['is_require'])->first();
        $customer_phone = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'phone')->select(['is_require'])->first();
        $customer_email = SettingsRequiredFields::where('model_type', Customer::class)->where('field', 'email')->select(['is_require'])->first();
        $orderedSupplys = OrderedSupply::pluck('id', 'tid');
        $orderedSupply_show = SettingsRequiredFields::where('model_type', OrderedSupply::class)->where('field', 'show')->select(['is_require'])->first();

        return view('focus.invoices.create')->with(array('orderedSupply_show' => $orderedSupply_show,'orderedSupplys' => $orderedSupplys,'customer_name' => $customer_name,'customer_phone' => $customer_phone,'customer_email' => $customer_email ,'last_invoice' => $last_invoice,'sub'=>$input['sub'],'p'=>$request->p,'salesChannels'=>$salesChannel,'employees'=>$employee))->with(bill_helper(1, 2));
    }
}
