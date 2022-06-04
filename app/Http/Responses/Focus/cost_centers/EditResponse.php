<?php

namespace App\Http\Responses\Focus\cost_centers;

use App\Models\Access\User\User;
use App\Models\costCenter\CostCenter;
use App\Models\customer\Customer;
use App\Models\screen\Screen;
use App\Models\supplier\Supplier;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\costCenter\CostCenter
     */
    protected $costcenter;

    /**
     * @param App\Models\costCenter\CostCenter $costcenter
     */
    public function __construct($costcenter)
    {
        $this->costcenter = $costcenter;
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

        $costcenter = $this->costcenter;
        $screen = Screen::find($this->costcenter->screen_id);
        $employees = User::pluck('increment', 'id');
        $customers = Customer::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
//        dd($employees);

        $costcenters = CostCenter::where('screen_id', $this->costcenter->screen_id)->get();
//        $lastcostcenterscode = CostCenter::all()->last() ? (CostCenter::all()->last()->id) + 1 : '';
        return view('focus.costcenters.create', [
            'costcenters' => $costcenters,
            'costcenter' => $costcenter,
            'screen' => $screen,
//            'last_code' => $lastcostcenterscode,
            'employees' => $employees,
            'customers' => $customers,
            'suppliers' => $suppliers
        ]);
    }
}