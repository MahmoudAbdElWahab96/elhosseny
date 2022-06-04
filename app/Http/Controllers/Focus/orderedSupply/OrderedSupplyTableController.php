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
namespace App\Http\Controllers\Focus\orderedSupply;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Focus\orderedSupply\ManageOrderedSupplyRequest;
use App\Repositories\Focus\orderedSupply\OrderedSupplyRepository;

/**
 * Class OrderedSupplyTableController.
 */
class OrderedSupplyTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var OrderedSupplyRepository
     */
    protected $orderedSupply;

    /**
     * contructor to initialize repository object
     * @param OrderedSupplyRepository $orderedSupply ;
     */
    public function __construct(OrderedSupplyRepository $orderedSupply)
    {
        $this->orderedSupply = $orderedSupply;
    }

    /**
     * This method return the data of the model
     * @param ManageOrderedSupplyRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageOrderedSupplyRequest $request)
    {
        //
        $core = $this->orderedSupply->getForDataTable();
        return Datatables::of($core)
            ->addIndexColumn()
            ->addColumn('tid', function ($orderedSupply) {
                return '<a class="font-weight-bold" href="' . route('biller.orderedSupply.show', [$orderedSupply->id]) . '">' . $orderedSupply->tid . '</a>';
            })
            ->addColumn('customer', function ($orderedSupply) {
                return $orderedSupply->customer->name . ' <a class="font-weight-bold" href="' . route('biller.customers.show', [$orderedSupply->customer->id]) . '"><i class="ft-eye"></i></a>';
            })
            ->addColumn('orderedSupplyDate', function ($orderedSupply) {
                return dateFormat($orderedSupply->orderedSupplydate);
            })
            ->addColumn('total', function ($orderedSupply) {
                return amountFormat($orderedSupply->total);
            })
            // ->addColumn('status', function ($orderedSupply) {
            //     return '<span class="st-' . $orderedSupply->status . '">' . trans('payments.' . $orderedSupply->status) . '</span>';
            // })
            ->addColumn('orderedSupplyduedate', function ($orderedSupply) {
                return dateFormat($orderedSupply->orderedSupplyduedate);
            })
            ->addColumn('actions', function ($orderedSupply) {
                return $orderedSupply->action_buttons;
            })->rawColumns(['tid', 'customer', 'actions', 'status', 'total','order_id'])
            ->make(true);
    }
}
