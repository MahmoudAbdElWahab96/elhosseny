<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\screens;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\costCenter\CostCenter;
use App\Models\screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\screens\CreateResponse;
use App\Http\Responses\Focus\screens\EditResponse;
use App\Repositories\Focus\screen\ScreenRepository;
use Illuminate\Support\Facades\DB;


/**
 * ScreensController
 */
class ScreensController extends Controller
{
    /**
     * variable to store the repository object
     * @var ScreenRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ScreenRepository $repository ;
     */
    public function __construct(ScreenRepository $repository)
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
        return new ViewResponse('focus.screens.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBankRequestNamespace $request
     * @return \App\Http\Responses\Focus\tax\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.screens.create');
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
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        $input['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('biller.screens.index'), ['flash_success' => trans('alerts.backend.screens.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(Screen $screen, ManageCompanyRequest $request)
    {
        return new EditResponse($screen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, Screen $screen)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required'
        ]);
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($screen, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.screens.index'), ['flash_success' => trans('alerts.backend.screens.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Screen $screen, ManageCompanyRequest $request)
    {
        //Calling the delete method on repository
        $cost_centers_count = CostCenter::where('screen_id', $screen->id)->count();
        if ($cost_centers_count > 0) {
            return new RedirectResponse(route('biller.screens.index'), ['flash_success' => trans('alerts.backend.screens.can_not_delete_this')]);

        } else {

            $this->repository->delete($screen);
            return new RedirectResponse(route('biller.screens.index'), ['flash_success' => trans('alerts.backend.screens.deleted')]);
        }
        //returning with successfull message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Screen $screen, ManageCompanyRequest $request)
    {

        //returning with successfull message
        return new ViewResponse('focus.screens.view', compact('screen'));
    }

}
