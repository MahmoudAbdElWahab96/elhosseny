<?php
/*
 * Rose Business Suite - Accounting, CRM and POS Software
 * Copyright (c) UltimateKode.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@ultimatekode.com
 *  Website: https://www.ultimatekode.com
 *
 *  ************************************************************************
 *  * This software is furnished under a license and may be used and copied
 *  * only  in  accordance  with  the  terms  of such  license and with the
 *  * inclusion of the above copyright notice.
 *  * If you Purchased from Codecanyon, Please read the full License from
 *  * here- http://codecanyon.net/licenses/standard/
 * ***********************************************************************
 */
namespace App\Http\Controllers\Focus\discount;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\additional\Additional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\discount\CreateResponse;
use App\Http\Responses\Focus\discount\EditResponse;
use App\Repositories\Focus\discount\DiscountRepository;


/**
 * DiscountsController
 */
class DiscountsController extends Controller
{
    /**
     * variable to store the repository object
     * @var DiscountRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param DiscountRepository $repository ;
     */
    public function __construct(DiscountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\discount\ManageDiscountRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.discounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateDiscountRequestNamespace $request
     * @return \App\Http\Responses\Focus\discount\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDiscountRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(ManageCompanyRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        $input['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('biller.discounts.index'), ['flash_success' => trans('alerts.backend.additionals.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\additional\Additional $additional
     * @param EditDiscountRequestNamespace $request
     * @return \App\Http\Responses\Focus\discount\EditResponse
     */
    public function edit($additional_id, ManageCompanyRequest $request)
    {

        $additional = Additional::find($additional_id);

        return new EditResponse($additional);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDiscountRequestNamespace $request
     * @param App\Models\additional\Additional $additional
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, $additional_id)
    {
        $additional = Additional::find($additional_id);

        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        $this->repository->update($additional, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.discounts.index'), ['flash_success' => trans('alerts.backend.discounts.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteDiscountRequestNamespace $request
     * @param App\Models\additional\Additional $additional
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy($additional_id, ManageCompanyRequest $request)
    {
        $additional = Additional::find($additional_id);

        //Calling the delete method on repository
        $this->repository->delete($additional);
        //returning with successfull message
        return new RedirectResponse(route('biller.discounts.index'), ['flash_success' => trans('alerts.backend.discounts.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteDiscountRequestNamespace $request
     * @param App\Models\additional\Additional $additional
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show($additional_id, ManageCompanyRequest $request)
    {
        $additional = Additional::find($additional_id);

        //returning with successfull message
        return new ViewResponse('focus.discounts.view', compact('additional'));
    }

}
