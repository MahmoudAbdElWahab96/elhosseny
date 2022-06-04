<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\globalsetting;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\globalsetting\GlobalSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\globalsettings\CreateResponse;
use App\Http\Responses\Focus\globalsettings\EditResponse;
use App\Repositories\Focus\globalsetting\GlobalSettingRepository;


/**
 * GlobalSettingsController
 */
class GlobalSettingsController extends Controller
{
    /**
     * variable to store the repository object
     * @var GlobalSettingRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param GlobalSettingRepository $repository ;
     */
    public function __construct(GlobalSettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\globalsetting\ManageBankRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.globalsettings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\globalsetting\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.globalsettings.create');
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
            'key' => 'required|string',
            'value' => 'required',
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        $input['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('biller.globalsettings.index'), ['flash_success' => trans('alerts.backend.globalsettings.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\globalsetting\globalsetting $globalsetting
     * @param EditBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\globalsetting\EditResponse
     */
    public function edit(GlobalSetting $globalsetting, ManageCompanyRequest $request)
    {
        return new EditResponse($globalsetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankRequestNamespace $request
     * @param App\Models\globalsetting\globalsetting $globalsetting
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, GlobalSetting $globalsetting)
    {
        $request->validate([
            'Desc_en' => 'required|string',
            'Desc_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($globalsetting, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.globalsettings.index'), ['flash_success' => trans('alerts.backend.globalsettings.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\globalsetting\globalsetting $globalsetting
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(globalsetting $globalsetting, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($globalsetting);
        //returning with successfull message
        return new RedirectResponse(route('biller.globalsettings.index'), ['flash_success' => trans('alerts.backend.globalsettings.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBankRequestNamespace $request
     * @param App\Models\globalsetting\globalsetting $globalsetting
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(GlobalSetting $globalsetting, ManageCompanyRequest $request)
    {

        //returning with successfull message
        return new ViewResponse('focus.globalsettings.view', compact('globalsetting'));
    }

}
