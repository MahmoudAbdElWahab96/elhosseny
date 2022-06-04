<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\tax;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\tax\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\taxes\CreateResponse;
use App\Http\Responses\Focus\taxes\EditResponse;
use App\Repositories\Focus\tax\TaxRepository;


/**
 * TaxesController
 */
class TaxesController extends Controller
{
    /**
     * variable to store the repository object
     * @var TaxRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param TaxRepository $repository ;
     */
    public function __construct(TaxRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\tax\ManageBankRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.taxes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\tax\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.taxes.create');
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
        return new RedirectResponse(route('biller.taxes.index'), ['flash_success' => trans('alerts.backend.taxes.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\tax\tax $bank
     * @param EditBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\tax\EditResponse
     */
    public function edit(Tax $tax, ManageCompanyRequest $request)
    {
        return new EditResponse($tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankRequestNamespace $request
     * @param App\Models\tax\tax $country
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, Tax $tax)
    {
        $request->validate([
            'Desc_en' => 'required|string',
            'Desc_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($tax, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.taxes.index'), ['flash_success' => trans('alerts.backend.taxes.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\tax\tax $bank
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Tax $tax, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($tax);
        //returning with successfull message
        return new RedirectResponse(route('biller.taxes.index'), ['flash_success' => trans('alerts.backend.taxes.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\tax\tax $bank
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Tax $tax, ManageCompanyRequest $request)
    {
        $additionals = $tax->additional;
        //returning with successfull message
        return new ViewResponse('focus.taxes.view', compact('tax','additionals'));
    }

}
