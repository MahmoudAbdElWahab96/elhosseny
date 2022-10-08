<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\account;

use App\Models\account\Account;
use App\Models\OpeningBalance\OpeningBalance;
use App\Models\Company\ConfigMeta;
use App\Models\screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\account\CreateResponse;
use App\Http\Responses\Focus\account\EditResponse;
use App\Repositories\Focus\account\AccountRepository;
use App\Http\Requests\Focus\account\ManageAccountRequest;
use App\Http\Requests\Focus\account\StoreAccountRequest;
use Illuminate\Support\Facades\Response;
use mPDF;
use App\Models\costCenter\CostCenter;


/**
 * AccountsController
 */
class AccountsController extends Controller
{
    /**
     * variable to store the repository object
     * @var AccountRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param AccountRepository $repository ;
     */
    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\account\ManageAccountRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageAccountRequest $request)
    {
        return new ViewResponse('focus.accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateAccountRequestNamespace $request
     * @return \App\Http\Responses\Focus\account\CreateResponse
     */
    public function create(StoreAccountRequest $request)
    {
        return new CreateResponse('focus.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreAccountRequest $request)
    {
        $request->validate([
            'number' => 'required',
            'holder' => 'required'
        ]);
        $costCentersScreens = CostCenter::find($request->cost_center_screens);

        //Input received from the request
        $input = $request->except(['_token', 'ins', 'cost_centers', 'cost_center_screens', 'cost_center_screens_names','parentAccountId']);

        $input['parent_account_id'] = $request->parent_account_id ? $request->parent_account_id : $request->account_type;
        $input['parent_account'] = Account::find($request->parent_account_id) ? Account::find($request->parent_account_id)->holder : optional(Account::find($request->account_type))->holder;
        $input['account_type'] = $request->account_type;
        $input['code'] = $request->number;
        $input['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        if($account = Account::create($input)){
            OpeningBalance::create($input);
            $account->screen()->attach($costCentersScreens);
        }
        //return with successfull message
        return new RedirectResponse(route('biller.accounts.index'), ['flash_success' => trans('alerts.backend.accounts.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\account\Account $account
     * @param EditAccountRequestNamespace $request
     * @return \App\Http\Responses\Focus\account\EditResponse
     */
    public function edit(Account $account, StoreAccountRequest $request)
    {
        return new EditResponse($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAccountRequestNamespace $request
     * @param App\Models\account\Account $account
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(StoreAccountRequest $request, Account $account)
    {
        $request->validate([
            'number' => 'required',
            'holder' => 'required'
        ]);

        $costCentersScreens = CostCenter::find($request->cost_center_screens);

        //Input received from the request
        $input = $request->except(['_token', 'ins',  'cost_centers', 'cost_center_screens', 'cost_center_screens_names','parentAccountId']);

        //Update the model using repository update method
        $input['parent_account_id'] = $request->parent_account_id ? $request->parent_account_id : $request->account_type;

        $input['parent_account'] = Account::find($request->parent_account_id) ? Account::find($request->parent_account_id)->holder : optional(Account::find($request->account_type))->holder;
        $input['account_type'] = $request->account_type;
        $input['code'] = $request->number;
        $input['ins'] = auth()->user()->ins;
        //update the model using repository update method
        if($account->update($input)){
            $account->screen()->detach();
            $account->screen()->attach($costCentersScreens);
        }
        //return with successfull message
        return new RedirectResponse(route('biller.accounts.index'), ['flash_success' => trans('alerts.backend.accounts.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteAccountRequestNamespace $request
     * @param App\Models\account\Account $account
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Account $account, StoreAccountRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($account);
        //returning with successfull message
        return new RedirectResponse(route('biller.accounts.index'), ['flash_success' => trans('alerts.backend.accounts.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteAccountRequestNamespace $request
     * @param App\Models\account\Account $account
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Account $account, ManageAccountRequest $request)
    {
        //returning with successfull message
        return new ViewResponse('focus.accounts.view', compact('account'));
    }

    public function balance_sheet(Request $request)
    {
        $bg_styles = array('bg-gradient-x-info', 'bg-gradient-x-purple', 'bg-gradient-x-grey-blue', 'bg-gradient-x-danger', 'bg-gradient-x-success', 'bg-gradient-x-warning');
        $array = [];
        $accounts = Account::where('level',1)->whereNull('account_type')->whereNull('parent_account_id')->get();
        $total_debit = 0;
        $total_credit = 0;
        foreach($accounts as $account){
            $total_debit += $account->debit;
            $total_credit += $account->credit;
        }
        $account_types = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 17)->first('value1');
        $last_level = (integer)ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 21)->first('value2')->value2;
        $account_types = json_decode($account_types->value1, true);
        $level = ConfigMeta::where('value1','cost_center_account_level')->first()->value2;
        if ($request->type == 'v') {
            return new ViewResponse('focus.accounts.balance_sheet', compact('level','accounts', 'bg_styles', 'account_types', 'last_level','total_credit','total_debit'));
        } else {

            $html = view('focus.accounts.print_balance_sheet', compact('account', 'account_types'))->render();
            $pdf = new \Mpdf\Mpdf(config('pdf'));
            $pdf->WriteHTML($html);
            $headers = array(
                "Content-type" => "application/pdf",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            return Response::stream($pdf->Output('balance_sheet.pdf', 'I'), 200, $headers);
        }

    }

    public function appendScreens(Request $request)
    {

        $screens = Screen::find($request->id);

        $html = view('focus.accounts._screens',
            [
                'request' => $request,
                'screens' => $screens,
            ])->render();
        return response()->json($html);
    }

    public function getCostCentersAccount($id)
    {
        $subAccounts = Account::where('account_type', $id)->pluck('holder', 'id');

        return response()->json($subAccounts);
    }

}

