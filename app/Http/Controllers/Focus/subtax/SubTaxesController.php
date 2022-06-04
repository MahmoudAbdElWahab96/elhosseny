<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\subtax;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\subtax\SubTax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\subtaxes\CreateResponse;
use App\Http\Responses\Focus\subtaxes\EditResponse;
use App\Repositories\Focus\subtax\SubTaxRepository;


/**
 * SubTaxesController
 */
class SubTaxesController extends Controller
{
    /**
     * variable to store the repository object
     * @var SubTaxRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param SubTaxRepository $repository ;
     */
    public function __construct(SubTaxRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\subtax\ManageBankRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.subtaxes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\subtax\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.subtaxes.create');
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
        return new RedirectResponse(route('biller.subtaxes.index'), ['flash_success' => trans('alerts.backend.subtaxes.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\subtax\SubTax $subtax
     * @param EditBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\subtax\EditResponse
     */
    public function edit(SubTax $subtax, ManageCompanyRequest $request)
    {
        return new EditResponse($subtax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankRequestNamespace $request
     * @param App\Models\subtax\subtax $country
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, SubTax $subtax)
    {
        $request->validate([
            'Desc_en' => 'required|string',
            'Desc_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($subtax, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.subtaxes.index'), ['flash_success' => trans('alerts.backend.subtaxes.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\subtax\SubTax $subtax
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(SubTax $subtax, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($subtax);
        //returning with successfull message
        return new RedirectResponse(route('biller.subtaxes.index'), ['flash_success' => trans('alerts.backend.subtaxes.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\subtax\SubTax $bank
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(SubTax $subtax, ManageCompanyRequest $request)
    {

        //returning with successfull message
        return new ViewResponse('focus.subtaxes.view', compact('subtax'));
    }

}
