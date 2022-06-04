<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */
namespace App\Http\Controllers\Focus\country;

use App\Http\Requests\Focus\general\ManageCompanyRequest;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Focus\country\CountryRepository;
use App\Http\Requests\Focus\country\ManageBankRequest;

/**
 * Class CountriesTableController.
 */
class CountriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var CountryRepository
     */
    protected $country;

    /**
     * contructor to initialize repository object
     * @param CountryRepository $country ;
     */
    public function __construct(CountryRepository $country)
    {
        $this->country = $country;
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
        $core = $this->country->getForDataTable();
        return Datatables::of($core)
            ->escapeColumns(['id'])
            ->addIndexColumn()
            ->addColumn('created_at', function ($country) {
                return Carbon::parse($country->created_at)->toDateString();
            })
            ->addColumn('actions', function ($country) {
                return $country->action_buttons;
            })
            ->make(true);
    }
}
