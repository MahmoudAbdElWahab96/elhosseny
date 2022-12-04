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
namespace App\Http\Controllers\Focus\productVariable;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use App\Models\productVariable\ProductVariable;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\productVariable\CreateResponse;
use App\Http\Responses\Focus\productVariable\EditResponse;
use App\Repositories\Focus\productVariable\ProductVariableRepository;

/**
 * ProductVariableController
 */
class ProductVariableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ProductVariableRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param ProductVariableRepository $repository ;
     */
    public function __construct(ProductVariableRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\productVariable\ManageProductVariableRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCompanyRequest $request)
    {
        return new ViewResponse('focus.productVariables.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateProductVariableRequestNamespace $request
     * @return \App\Http\Responses\Focus\productVariable\CreateResponse
     */
    public function create(ManageCompanyRequest $request)
    {
        return new CreateResponse('focus.productVariables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductVariableRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(ManageCompanyRequest $request)
    {
        $input = $request->except(['_token', 'data']);

        $input['ins'] = auth()->user()->ins;

        $productVariable = $this->repository->create($input);

        $variables = $request->data;
        foreach($variables as $variable){
            $data = [
                'value' => $variable,
                'ins' => auth()->user()->ins
            ];

            $productVariable->variationValues()->create($data);
        }

        //return with successfull message
        return new RedirectResponse(route('biller.product-variables.index'), ['flash_success' => trans('alerts.backend.productVariables.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\productVariable\ProductVariable $productVariable
     * @param EditProductVariableRequestNamespace $request
     * @return \App\Http\Responses\Focus\productVariable\EditResponse
     */
    public function edit(ProductVariable $productVariable, ManageCompanyRequest $request)
    {
        return new EditResponse($productVariable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductVariableRequestNamespace $request
     * @param App\Models\productVariable\Productvariable $productVariable
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageCompanyRequest $request, ProductVariable $productVariable)
    {
        //Input received from the request
        $input = $request->except(['_token', 'ins']);
        //Update the model using repository update method
        if ($input['val'] < 1) $input['val'] = 1;
        $this->repository->update($productVariable, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.product-variables.index'), ['flash_success' => trans('alerts.backend.productVariables.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteProductVariableRequestNamespace $request
     * @param App\Models\productVariable\ProductVariable $productVariable
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(ProductVariable $productVariable, ManageCompanyRequest $request)
    {
        $productVariable->variationValues()->delete();        
        //Calling the delete method on repository
        $this->repository->delete($productVariable);
       //returning with successfull message
        return new RedirectResponse(route('biller.product-variables.index'), ['flash_success' => trans('alerts.backend.productVariables.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteProductVariableRequestNamespace $request
     * @param App\Models\productVariable\ProductVariable $productVariable
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(ProductVariable $productVariable, ManageCompanyRequest $request)
    {

        //returning with successfull message
        return new ViewResponse('focus.productVariables.view', compact('productVariable'));
    }

}
