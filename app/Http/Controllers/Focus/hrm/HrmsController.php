<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\hrm;

use App\Exceptions\GeneralException;
use App\Http\Requests\Focus\department\ManageDepartmentRequest;
use App\Http\Resources\RoleResource;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Permission\PermissionRole;
use App\Models\Access\Permission\PermissionUser;
use App\Models\Access\Role\Role;
use App\Models\account\Account;
use App\Models\Company\ConfigMeta;
use App\Models\department\Department;
use App\Models\employee\RoleUser;
use App\Models\hrm\Attendance;
use App\Models\hrm\Hrm;
use App\Models\transactioncategory\Transactioncategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\hrm\CreateResponse;
use App\Http\Responses\Focus\hrm\EditResponse;
use App\Repositories\Focus\hrm\HrmRepository;
use App\Http\Requests\Focus\hrm\ManageHrmRequest;
use Yajra\DataTables\Facades\DataTables;
use DB;

/**
 * HrmsController
 */
class HrmsController extends Controller
{
    /**
     * variable to store the repository object
     * @var HrmRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param HrmRepository $repository ;
     */
    public function __construct(HrmRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\hrm\ManageHrmRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageHrmRequest $request)
    {
        $title = trans('labels.backend.hrms.management');
        $flag = true;
        if (request('rel_type') == 3) {
            $title = trans('hrms.payroll');
            $flag = false;
        }
        return new ViewResponse('focus.hrms.index', compact('title', 'flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateHrmRequestNamespace $request
     * @return \App\Http\Responses\Focus\hrm\CreateResponse
     */
    public function create(ManageHrmRequest $request)
    {
        return new CreateResponse('focus.hrms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHrmRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(ManageHrmRequest $request)
    {


        //Input received from the request
        $input['employee'] = $request->only(['first_name', 'last_name', 'email', 'picture', 'signature', 'password', 'role', 'increment']);
        $input['profile'] = $request->only(['contact', 'company', 'address_1', 'city', 'state', 'country', 'tax_id', 'postal']);
        $input['meta'] = $request->only(['department_id', 'salary', 'hra', 'entry_time', 'exit_time', 'sales_commission', 'shift', 'vacation']);
        $input['permission'] = $request->only(['permission']);
        $input['employee']['ins'] = auth()->user()->ins;

        if (!empty($input['employee']['password'])) {
            $request->validate([
                'password' => ['required',
                    'min:6',
                    'string',
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character]
                ],
                // 'increment' => 'required|numeric'
            ]);
        }

        if (!empty($input['employee']['picture'])) {
            $request->validate([
                'picture' => 'required|mimes:jpeg,png',
            ]);
        }
        if (!empty($input['employee']['signature'])) {
            $request->validate([
                'signature' => 'required|mimes:jpeg,png',
            ]);
        }

        //Create the model using repository create method
        try {
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('biller.hrms.index'), ['flash_success' => trans('alerts.backend.hrms.created')]);
        }
        catch (\Exception $e){
            return new RedirectResponse(route('biller.hrms.index'), ['flash_error' => ' Code'.$e->getCode()]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\hrm\Hrm $hrm
     * @param EditHrmRequestNamespace $request
     * @return \App\Http\Responses\Focus\hrm\EditResponse
     */
    public function edit(Hrm $hrm, ManageHrmRequest $request)
    {
        return new EditResponse($hrm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHrmRequestNamespace $request
     * @param App\Models\hrm\Hrm $hrm
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ManageHrmRequest $request, Hrm $hrm)
    {
        //Input received from the request
        // $input = $request->only(['first_name', 'last_name', 'email', 'picture', 'signature', 'password']);


        //Input received from the request
        $input['employee'] = $request->only(['first_name', 'last_name', 'email', 'picture', 'signature', 'password', 'role','increment']);
        if (!empty($input['employee']['password'])) {
            $request->validate([
                'password' => ['required',
                    'min:6',
                    'string',
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character]
                ]]);
        }
        if (!empty($input['employee']['picture'])) {
            $request->validate([
                'picture' => 'required|mimes:jpeg,png',
            ]);
        }
        if (!empty($input['employee']['signature'])) {
            $request->validate([
                'signature' => 'required|mimes:jpeg,png',
            ]);
        }
        $input['profile'] = $request->only(['contact', 'company', 'address_1', 'city', 'state', 'country', 'tax_id', 'postal']);
        $input['meta'] = $request->only(['salary', 'hra', 'entry_time', 'exit_time', 'commission', 'department_id', 'shift']);
        $input['employee']['ins'] = auth()->user()->ins;
        $input['permission'] = $request->only(['permission']);

        //Update the model using repository update method
        $this->repository->update($hrm, $input);
        //return with successfull message
        return new RedirectResponse(route('biller.hrms.index'), ['flash_success' => trans('alerts.backend.hrms.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteHrmRequestNamespace $request
     * @param App\Models\hrm\Hrm $hrm
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Hrm $hrm, ManageHrmRequest $request)
    {
        //Calling the delete method on repository
        //$this->repository->delete($hrm);
        //returning with successfull message
        return new RedirectResponse(route('biller.hrms.index'), ['flash_success' => trans('alerts.backend.hrms.deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteHrmRequestNamespace $request
     * @param App\Models\hrm\Hrm $hrm
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(Hrm $hrm, ManageHrmRequest $request)
    {
        $emp_role = @$hrm->role['id'];
        $permissions_all = Permission::orderBy('display_name', 'asc')->whereHas('roles', function ($q) use ($emp_role) {
            return $q->where('role_id', '=', $emp_role);
        })->get()->toArray();
        $permissions = PermissionUser::all()->keyBy('id')->where('user_id', '=', $hrm->id)->toArray();

        // $rolePermissions =PermissionRole::all()->keyBy('id')->where('role_id','=',$emp_role)->toArray();


        //returning with successfull message
        return new ViewResponse('focus.hrms.view', compact('hrm', 'permissions', 'permissions_all'));
    }

    public function set_permission(ManageHrmRequest $request)
    {
        //$request->uid
        $hrm = RoleUser::where('user_id', '=', $request->uid)->first();
        if ($hrm['role_id']) {
            $permission = PermissionRole::where('role_id', '=', $hrm['role_id'])->where('permission_id', '=', $request->pid)->first();
            if ($permission['permission_id']) {
                if (!$request->active) {
                    $permission_user = new PermissionUser;
                    $permission_user->permission_id = $permission['permission_id'];
                    $permission_user->user_id = $hrm['user_id'];
                    $permission_user->save();
                } else {
                    if ($permission['permission_id'] == 29 and $hrm['role_id'] == 2) {

                    } else {
                        PermissionUser::where('permission_id', $permission['permission_id'])->where('user_id', $hrm['user_id'])->delete();
                    }
                }

            }
        }
    }

    public function payroll(ManageDepartmentRequest $request)
    {
        $accounts = Account::all();
        $transaction_categories = Transactioncategory::all();
        $payroll = true;
        $dual_entry = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 13)->first('feature_value');
        return view('focus.transactions.create', compact('accounts', 'transaction_categories', 'payroll', 'dual_entry'));
    }


    public function attendance(ManageDepartmentRequest $request)
    {
        $payroll = true;
        return view('focus.hrms.attendance', compact('payroll'));
    }

    public function attendance_store(ManageDepartmentRequest $request)
    {
        // dd($request);
        $user = Hrm::find($request->payer_id);
        $present = date_for_database($request->att_date);
        $act_h = (strtotime($request->time_from) - strtotime($request->time_to)) / 3600;
        if ($user->id) Attendance::create(array('user_id' => $user->id, 'present' => $present, 't_from' => $request->time_from, 't_to' => $request->time_to, 'note' => $request->note, 'actual_hours' => $act_h, 'ins' => $user->ins));
        return new RedirectResponse(route('biller.hrms.attendance'), ['flash_success' => trans('hrms.attendance_recorded')]);
    }

    public function attendance_list(ManageDepartmentRequest $request)
    {
        $payroll = true;
        return view('focus.hrms.attendance_list', compact('payroll'));
    }

    public function attendance_load(ManageDepartmentRequest $request)
    {
        $attendance = Attendance::query()->select([
            'id',
            'user_id',
//            'present',
//            't_from',
//            't_to',
            'attendance_type',
            'image',
            'created_at',
            'ip_address',
            'latitude',
            'longtitude'
        ]);
        if (request('rel_id')) {
            $user = Hrm::find(request('rel_id'));
            $attendance->where('user_id', '=', $user->id);
        }
        $attendance->get();
        return DataTables::of($attendance)
            ->escapeColumns(['id'])
            ->addIndexColumn()
            ->addColumn('name', function ($attendance) {
                return '<a class="font-weight-bold" href="' . route('biller.hrms.show', [$attendance->id]) . '">' . $attendance->user['first_name'] . ' ' . $attendance->user['last_name'] . '</a>';
            })
            ->addColumn('present', function ($attendance) {
                return dateTimeFormat($attendance->created_at);
            })
            ->addColumn('ip_address', function ($attendance) {
                return ($attendance->ip_address);
            })
                ->addColumn('t_from', function ($attendance) {
                return ($attendance->t_from);
            })
            ->addColumn('t_to', function ($attendance) {
                return ($attendance->t_to);
            })
            ->addColumn('latitude', function ($attendance) {
                return ($attendance->latitude);
            })
            ->addColumn('longtitude', function ($attendance) {
                return ($attendance->longtitude);
            })
//            ->addColumn('t_from', function ($attendance) {
//                return ($attendance->t_from);
//            })
//            ->addColumn('t_to', function ($attendance) {
//                return ($attendance->t_to);
//            })
            ->addColumn('attendance_type', function ($attendance) {
                return (__('general.attendance_list.' . $attendance->attendance_type));
            })
            ->addColumn('image', function ($attendance) {

                return '<a href="' . $attendance->image . '" data-fancybox="gallery" data-caption="Caption Images 1">
                <img src="' . $attendance->image . '" alt="Image Gallery" width="50" height="50">
              </a>';
                //return '<image class="font-weight-bold" src="' . $attendance->image . '"width="30" height="30">';
            })
            ->addColumn('remove', function ($attendance) {
                $btn = '<a href="#" id="a_' . $attendance['id'] . '" class=" delete-object"
                                                                                  data-object-type="2"
                                                                                  data-object-id="' . $attendance['id'] . '"><i
                                                                    class="danger fa fa-trash"></i></a>';

                return $btn;
            })
            ->make(true);

    }

    public function attendance_destroy(ManageDepartmentRequest $request)
    {
        //Calling the delete method on repository
        Attendance::where('id', '=', $request->object_id)->delete();
        return json_encode(array('status' => 'Success', 'message' => trans('general.delete_success'), 't_type' => 1, 'meta' => $request->object_id));
    }


    public function related_permission(ManageHrmRequest $request)
    {
        $emp_role = $request->post('rid');
        $create = $request->post('create');
        $permissions = '';
        $permissions_all = \App\Models\Access\Permission\Permission::orWhereHas('roles', function ($q) use ($emp_role) {
            return $q->where('role_id', '=', $emp_role);
        })->get()->toArray();
        if ($create > 1) $permissions = \App\Models\Access\Permission\PermissionUser::all()->keyBy('id')->where('user_id', '=', $create)->toArray();
        return view('focus.hrms.partials.permissions')->with(compact('permissions_all', 'create', 'permissions'));
    }


    public function role_permission(ManageHrmRequest $request)
    {
        $emp_role = $request->post('rid');
        $create = $request->post('create');
        $permissions = '';
        // $permissions_all = \App\Models\Access\Permission\Permission::orWhereHas('roles', function ($q) use ($emp_role) {
        //     return $q->where('role_id', '=', $emp_role);
        // })->get()->toArray();
        $permissions_all = \App\Models\Access\Permission\Permission::get()->toArray();

        $permissions_all_data = [];
        foreach($permissions_all as $permission){
            if(str_contains($permission['name'],'customer')){
                $permissions_all_data['customer'][] = array(    // push key,value in $new_array
                     $permission,
                );
            }
            if(str_contains($permission['name'],'payment')){
                $permissions_all_data['payment'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'warehouse')){
                $permissions_all_data['warehouse'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'productcategory')){
                $permissions_all_data['productcategory'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'product')){
                $permissions_all_data['product'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'invoice')){
                $permissions_all_data['invoice'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'account')){
                $permissions_all_data['account'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'transaction')){
                $permissions_all_data['transaction'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'hrm')){
                $permissions_all_data['hrm'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'department')){
                $permissions_all_data['department'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'quote')){
                $permissions_all_data['quote'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'purchaseorder')){
                $permissions_all_data['purchaseorder'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'supplier')){
                $permissions_all_data['supplier'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'dashboard')){
                $permissions_all_data['dashboard'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'reports')){
                $permissions_all_data['reports'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'stockreturn')){
                $permissions_all_data['stockreturn'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'creditnote')){
                $permissions_all_data['creditnote'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'stocktransfer')){
                $permissions_all_data['stocktransfer'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'task')){
                $permissions_all_data['task'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'business_settings')){
                $permissions_all_data['business_settings'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'misc')){
                $permissions_all_data['misc'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'project')){
                $permissions_all_data['project'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'note')){
                $permissions_all_data['note'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'event')){
                $permissions_all_data['event'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'communication')){
                $permissions_all_data['communication'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'POS')){
                $permissions_all_data['POS'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
            if(str_contains($permission['name'],'import')){
                $permissions_all_data['import'][] = array(    // push key,value in $new_array
                    $permission,
               );
            }
        }
        if ($create) $permissions = \App\Models\Access\Permission\PermissionUser::all()->keyBy('id')->where('user_id', '=', $create)->toArray();
        $role = Role::find($emp_role);
        // $rolePermissions = $role->permissions->pluck('id')->all();
        return view('focus.hrms.partials.role_permissions')->with(compact('permissions_all_data','permissions_all', 'create', 'permissions', 'role'));
    }


    public function active(ManageHrmRequest $request)
    {
        $cid = $request->post('cid');
        $active = $request->post('active');
        $active = !(bool)$active;
        if ($cid != auth()->user()->id) {
            \App\Models\hrm\Hrm::where('id', '=', $cid)->update(array('status' => $active));
        }
    }


    public function admin_permissions(ManageHrmRequest $request)
    {
        $emp_role = $request->post('rid');
        $create = $request->post('create');
        $permissions = '';
        $permissions_all = \App\Models\Access\Permission\Permission::orWhereHas('roles', function ($q) use ($emp_role) {
            return $q->where('role_id', '=', $emp_role);
        })->get()->toArray();
        if ($create) $permissions = \App\Models\Access\Permission\PermissionUser::all()->keyBy('id')->where('user_id', '=', $create)->toArray();
        return view('focus.hrms.partials.admin_permissions')->with(compact('permissions_all', 'create', 'permissions'));
    }

    public function attendanceView(Request $request)
    {
        return view('focus.modal.pos_attendance_modal');

    }

    public function attendanceActionsStore(Request $request)
    {
//        dd($request->all());
        // set IP address and API access key
//        $ip = get_client_ip();
        // $link ='http://ip-api.com/php/197.165.161.208';
        // $ip = '154.236.150.122';
        // $access_key = '02f7108ce8121cbe4fad6d8932392851';
        $ipp = \Request::ip();
        if ($ipp != "::1") {
            $ch = curl_init('http://ip-api.com/php/' . $ipp);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response:
            $api_result = unserialize($json);
            $lat = $api_result['lat'];
            $lon = $api_result['lon'];
        } else {
            $lat = '';
            $lon = '';
        }

//        echo $api_result['location']['calling_code'];
//        $user = auth()->user();
        $user = Hrm::where('increment', $request->user_code)->first();
        if ($user == null) {
            $user = auth()->user();
        }

        $present = date_for_database($request->att_date);
        $act_h = (strtotime($request->time_from) - strtotime($request->time_to)) / 3600;
        if ($user->id) Attendance::create(array(
            'user_id' => $user->id,
            'present' => $present,
//            't_from' => $request->time_from,
//            't_to' => $request->time_to,
            'note' => $request->note,
            'image' => $request->image,
            'attendance_type' => $request->attendance_type,
//            'actual_hours' => $act_h,
            'latitude' => $lat,
            'longtitude' => $lon,
            'ip_address' => get_client_ip() == "::1" ? '127.0.0.1' : get_client_ip(),
            'ins' => $user->ins));
        return new RedirectResponse(route('biller.hrms.attendance_list'), ['flash_success' => trans('hrms.attendance_recorded')]);
    }

    public function getUserByCode(Request $request)
    {
        $user = Hrm::where('increment', $request->code)->first();
        if ($user != null) {

            $data = $user->first_name . ' ' . $user->last_name;
        } else {
            $data = trans('general.user_not_found');
        }
        return response()->json($data);

    }

    public function getHrmsRoles(Request $request)
    {
        $roles=Role::where('status','<',1)->where(function ($query) {
            $query->where('ins', '=', auth()->user()->ins)->orWhereNull('ins');})->get();

        $general['create']=1;

        $users = Hrm::all();

        return view('focus.hrms.createHrmsRoles',compact('general','roles', 'users'));
    }

    public function storeHrmsRoles(Request $request){
        DB::beginTransaction();
        $role = $request->role;
        $hrm = Hrm::find($request->user_id);

        $role_valid = Role::where(function ($query) use($hrm) {
            $query->where('ins', '=', $hrm->ins)->orWhereNull('ins');
        })->where('id', '=', $role)->first();

        if ($role_valid->status < 1) {
            unset($request->role);

            RoleUser::create(array('user_id' => $hrm->id, 'role_id' => $role));
            if (isset($request->permissions)){
                $hrm->permissions()->attach($request->permissions);
            }

            DB::commit();
            if ($hrm->id) {
                return new RedirectResponse(route('biller.hrms.index'), ['flash_success' => trans('alerts.backend.hrms.created')]);
            }
        }

    }
}
