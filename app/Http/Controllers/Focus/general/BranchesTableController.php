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
namespace App\Http\Controllers\Focus\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\Focus\branch\ManageBranchRequest;
use App\Repositories\Focus\branch\BranchRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BranchesTableController.
 */
class BranchesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var BranchRepository
     */
    protected $branch;

    /**
     * contructor to initialize repository object
     * @param BranchRepository $branch ;
     */
    public function __construct(BranchRepository $branch)
    {
        $this->branch = $branch;
    }

    /**
     * This method return the data of the model
     * @param ManageBranchRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBranchRequest $request)
    {
        $core = $this->branch->getForDataTable();
        return Datatables::of($core)
            ->escapeColumns(['id'])
            ->addIndexColumn()
            ->addColumn('created_at', function ($branch) {
                return Carbon::parse($branch->created_at)->toDateString();
            })
            ->addColumn('actions', function ($branch) {
                return $branch->action_buttons;
            })
            ->make(true);
    }
}
