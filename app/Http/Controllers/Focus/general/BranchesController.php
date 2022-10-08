<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\general;

use App\Models\OpeningBalance\OpeningBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\branch\CreateResponse;
use App\Http\Responses\Focus\branch\EditResponse;
use App\Http\Requests\Focus\branch\ManageBranchRequest;
use App\Http\Requests\Focus\branch\StoreBranchRequest;
use App\Models\Company\Branch;
use App\Models\Company\Company;
use Illuminate\Support\Facades\Response;
use mPDF;
use App\Models\costCenter\CostCenter;
use App\Repositories\Focus\branch\BranchRepository;

/**
 * AccountsController
 */
class BranchesController extends Controller
{
    /**
     * variable to store the repository object
     * @var BranchRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param BranchRepository $repository ;
     */
    public function __construct(BranchRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\branch\ManageBranchRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageBranchRequest $request)
    {
        return new ViewResponse('focus.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBranchtRequestNamespace $request
     * @return \App\Http\Responses\Focus\branch\CreateResponse
     */
    public function create(StoreBranchRequest $request)
    {
        return new CreateResponse('focus.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreBranchRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'company_id' => 'required'
        ]);

        //Input received from the request
        $input = $request->except(['_token']);

        //Create the model using repository create method
        Branch::create($input);

        //return with successfull message
        return new RedirectResponse(route('biller.branches.index'), ['flash_success' => trans('alerts.backend.branches.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\branch\Branch $branch
     * @param EditBranchRequestNamespace $request
     * @return \App\Http\Responses\Focus\branch\EditResponse
     */
    public function edit(Branch $branch, StoreBranchRequest $request)
    {
        return new EditResponse($branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBranchRequestNamespace $request
     * @param App\Models\branch\Branch $branch
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(StoreBranchRequest $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required',
            'company_id' => 'required'
        ]);


        //Input received from the request
        $input = $request->except(['_token']);

        $branch->update($input);

        //return with successfull message
        return new RedirectResponse(route('biller.branches.index'), ['flash_success' => trans('alerts.backend.brancges.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBranchRequestNamespace $request
     * @param App\Models\branch\Branch $branch
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Branch $branch, StoreBranchRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($branch);
        //returning with successfull message
        return new RedirectResponse(route('biller.branches.index'), ['flash_success' => trans('alerts.backend.accounts.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBranchRequestNamespace $request
     * @param App\Models\branch\Branch $branch
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Branch $branch, ManageBranchRequest $request)
    {
        //returning with successfull message
        return new ViewResponse('focus.branches.view', compact('branch'));
    }

    public function updateUserBranch($id){

        $branch = Branch::find($id);

        if($branch){
            $user = auth()->user();

            $user->branch_id = $id;

            $user->save();
        }

        return new RedirectResponse(route('biller.dashboard'), ['flash_success' => trans('alerts.backend.accounts.update')]);
    }

}

