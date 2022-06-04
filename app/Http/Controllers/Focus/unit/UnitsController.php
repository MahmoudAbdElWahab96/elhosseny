<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\unit;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\unit\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\units\CreateResponse;
use App\Http\Responses\Focus\units\EditResponse;
use App\Repositories\Focus\unit\UnitRepository;


/**
 * UnitsController
 */
class UnitsController extends Controller
{
    /**
     * variable to store the repository object
     * @var UnitRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param UnitRepository $repository ;
     */
    public function __construct(UnitRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\unit\ManageBankRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.units.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\unit\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBankRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(ManageCompanyRequest $request)
    {
        $request->validate([
            'Desc_en' => 'required|string',
            'Desc_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        $input['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('biller.units.index'), ['flash_success' => trans('alerts.backend.units.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\unit\unit $bank
     * @param EditBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\unit\EditResponse
     */
    public function edit(Unit $unit, ManageCompanyRequest $request)
    {
        return new EditResponse($unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankRequestNamespace $request
     * @param App\Models\unit\unit $unit
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, Unit $unit)
    {
        $request->validate([
            'Desc_en' => 'required|string',
            'Desc_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($unit, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.units.index'), ['flash_success' => trans('alerts.backend.units.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\unit\unit $unit
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Unit $unit, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($unit);
        //returning with successfull message
        return new RedirectResponse(route('biller.units.index'), ['flash_success' => trans('alerts.backend.units.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\unit\unit $bank
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Unit $unit, ManageCompanyRequest $request)
    {

        //returning with successfull message
        return new ViewResponse('focus.units.view', compact('unit'));
    }

}
