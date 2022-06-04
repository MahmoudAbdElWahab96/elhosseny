<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\tax;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Focus\tax\TaxRepository;
use App\Http\Requests\Focus\tax\ManageBankRequest;

/**
 * Class TaxesTableController.
 */
class TaxesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var TaxRepository
     */
    protected $resource;

    /**
     * contructor to initialize repository object
     * @param TaxRepository $country ;
     */
    public function __construct(TaxRepository $resource)
    {
        $this->resource = $resource;
    }

    /**
     * This method return the data of the model
     * @param ManageBankRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCompanyRequest $request)
    {
        //
        $core = $this->resource->getForDataTable();
        return Datatables::of($core)
            ->escapeColumns(['id'])
            ->addIndexColumn()
            ->addColumn('created_at', function ($resource) {
                return Carbon::parse($resource->created_at)->toDateString();
            })
            ->addColumn('actions', function ($resource) {
                return $resource->action_buttons;
            })
            ->make(true);
    }
}
