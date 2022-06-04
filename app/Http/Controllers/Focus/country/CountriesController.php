<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\country;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\country\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\countries\CreateResponse;
use App\Http\Responses\Focus\countries\EditResponse;
use App\Repositories\Focus\country\CountryRepository;


/**
 * CountriesController
 */
class CountriesController extends Controller
{
    /**
     * variable to store the repository object
     * @var CountryRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param CountryRepository $repository ;
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\country\ManageBankRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\country\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.countries.create');
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
        return new RedirectResponse(route('biller.countries.index'), ['flash_success' => trans('alerts.backend.countries.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\country\country $bank
     * @param EditBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\country\EditResponse
     */
    public function edit(Country $country, ManageCompanyRequest $request)
    {
        return new EditResponse($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankRequestNamespace $request
     * @param App\Models\country\country $country
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, Country $country)
    {
        $request->validate([
            'Desc_en' => 'required|string',
            'Desc_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($country, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.countries.index'), ['flash_success' => trans('alerts.backend.countries.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\country\country $bank
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Country $country, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($country);
        //returning with successfull message
        return new RedirectResponse(route('biller.countries.index'), ['flash_success' => trans('alerts.backend.countries.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\country\country $bank
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Country $country, ManageCompanyRequest $request)
    {

        //returning with successfull message
        return new ViewResponse('focus.countries.view', compact('country'));
    }

}
