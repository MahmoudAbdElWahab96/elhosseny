<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\openingBalance;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Focus\openingBalance\OpeningBalanceRepository;
use App\Http\Requests\Focus\openingBalance\ManageOpeningBalanceRequest;

/**
 * Class OpeningBalanceTableController.
 */
class OpeningBalanceTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var OpeningBalanceRepository
     */
    protected $opening;

    /**
     * contructor to initialize repository object
     * @param OpeningBalanceRepository $opening ;
     */
    public function __construct(OpeningBalanceRepository $opening)
    {
        $this->opening = $opening;
    }

    /**
     * This method return the data of the model
     * @param ManageOpeningBalanceRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageOpeningBalanceRequest $request)
    {
        $core = $this->opening->getForDataTable();
        return Datatables::of($core)
            ->escapeColumns(['id', 'number', 'holder'])
            ->addIndexColumn()
            ->addColumn('balance', function ($opening) {
                return amountFormat($opening->balance);
            })
            ->addColumn('account_type', function ($opening) {
                return trans('accounts.' . $opening->account_type);
            })
            ->addColumn('created_at', function ($opening) {
                return dateFormat($opening->created_at);
            })
            ->addColumn('actions', function ($opening) {
                return $opening->action_buttons;
            })
            ->make(true);
    }
}
