<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\cost_centers;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\Access\User\User;
use App\Models\costCenter\CostCenter;
use App\Models\customer\Customer;
use App\Models\screen\Screen;
use App\Models\supplier\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\cost_centers\CreateResponse;
use App\Http\Responses\Focus\cost_centers\EditResponse;
use App\Repositories\Focus\costcenter\CostCenterRepository;


/**
 * CostCentersController
 */
class CostCentersController extends Controller
{
    /**
     * variable to store the repository object
     * @var CostCenterRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param CostCenterRepository $repository ;
     */
    public function __construct(CostCenterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.costcenters.index');
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.costcenters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(ManageCompanyRequest $request)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'code' => 'required|unique:cost_centers',
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        $input['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('biller.CostCentersByScreenID',
            [$request->screen_id]),
            ['flash_success' => trans('alerts.backend.costcenters.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(CostCenter $costcenter, ManageCompanyRequest $request)
    {
        return new EditResponse($costcenter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, CostCenter $costcenter)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $screen_id = $costcenter->screen_id;

        $this->repository->update($costcenter, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.CostCentersByScreenID', [$screen_id]), ['flash_success' => trans('alerts.backend.costcenters.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(CostCenter $costcenter, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $screen_id = $costcenter->screen_id;
        $this->repository->delete($costcenter);
        //returning with successfull message
        return new RedirectResponse(route('biller.CostCentersByScreenID', [$screen_id]), ['flash_success' => trans('alerts.backend.costcenters.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(CostCenter $costcenter, ManageCompanyRequest $request)
    {

        $costcenter = $costcenter;
        $screen = Screen::find($costcenter->screen_id);
        $employees = User::pluck('increment', 'id');
        $customers = Customer::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
//        dd($employees);

        $costcenters = CostCenter::where('screen_id', $costcenter->screen_id)->get();
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

    public function CostCentersByScreenID($screen_id)
    {
        $screen = Screen::find($screen_id);
        $employees = User::pluck('increment', 'id');
        $customers = Customer::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');
//        dd($employees);

        $costcenters = CostCenter::where('screen_id', $screen_id)->get();
//        $lastcostcenterscode = CostCenter::all()->last() ? (CostCenter::all()->last()->id) + 1 : '';
        return view('focus.costcenters.create', [
            'costcenters' => $costcenters,
            'screen' => $screen,
//            'last_code' => $lastcostcenterscode,
            'employees' => $employees,
            'customers' => $customers,
            'suppliers' => $suppliers
        ]);

    }

    public function getEmployeeData(Request $request)
    {
        $employee = User::find($request->employee);
        return response()->json($employee);
    }

    public function getCustomerData(Request $request)
    {
        $customer = Customer::find($request->customer);
        return response()->json($customer);
    }

    public function getSupplierData(Request $request)
    {
        $supplier = Supplier::find($request->supplier);
        return response()->json($supplier);
    }

    public function getAllCostCenters()
    {
        $screens = Screen::all();
        $employees = User::pluck('increment', 'id');
        $customers = Customer::pluck('name', 'id');
        $suppliers = Supplier::pluck('name', 'id');

        $costcenters = CostCenter::get();

        return view('focus.costcenters.costCenters', [
            'costcenters' => $costcenters,
            'screens' => $screens,
            'employees' => $employees,
            'customers' => $customers,
            'suppliers' => $suppliers
        ]);
    }

}
