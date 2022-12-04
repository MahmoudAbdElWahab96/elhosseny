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
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Focus\productVariable\ProductVariableRepository;
use App\Http\Requests\Focus\productVariable\ManageProductVariableRequest;

/**
 * Class ProductVariableTableController.
 */
class ProductVariableTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ProductVariableRepository
     */
    protected $productVariable;

    /**
     * contructor to initialize repository object
     * @param ProductVariableRepository $productVariable ;
     */
    public function __construct(ProductVariableRepository $productVariable)
    {
        $this->productVariable = $productVariable;
    }

    /**
     * This method return the data of the model
     * @param ManageProductVariableRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCompanyRequest $request)
    {
        //
        $core = $this->productVariable->getForDataTable();
        return Datatables::of($core)
            ->escapeColumns(['id'])
            ->addIndexColumn()
            ->addColumn('created_at', function ($productVariable) {
                return Carbon::parse($productVariable->created_at)->toDateString();
            })
            ->addColumn('actions', function ($productVariable) {
                return $productVariable->action_buttons;
            })
            ->make(true);
    }
}
