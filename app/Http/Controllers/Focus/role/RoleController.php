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
namespace App\Http\Controllers\Focus\role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Focus\hrm\ManageHrmRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Access\Role\Role;
use App\Repositories\Focus\role\PermissionRepository;
use App\Repositories\Focus\role\RoleRepository;

/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Access\Role\RoleRepository
     */
    protected $repository;

    /**
     * @var \App\Repositories\Backend\Access\Permission\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Repositories\Backend\Access\Role\RoleRepository $roles
     * @param \App\Repositories\Backend\Access\Permission\PermissionRepository $permissions
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissions)
    {
        $this->repository = $repository;
        $this->permissions = $permissions;
    }

    /**
     * @param \App\Http\Requests\Backend\Access\Role\ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageHrmRequest $request)
    {
        return new ViewResponse('focus.hrms.roles.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Access\Role\CreateRoleRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\Role\CreateResponse
     */
    public function create(ManageHrmRequest $request)
    {
        $permissions_all = $this->permissions->getAll()->toArray();

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

        return view('focus.hrms.roles.create',compact('permissions_all_data'))
            ->withPermissions($this->permissions->getAll())
            ->withRoleCount($this->repository->getCount());

    }

    /**
     * @param \App\Http\Requests\Backend\Access\Role\StoreRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(ManageHrmRequest $request)
    {
        $this->repository->create($request->all());

        return new RedirectResponse(route('biller.role.index'), ['flash_success' => trans('alerts.backend.roles.created')]);
    }

    /**
     * @param \App\Models\Access\Role\Role $role
     * @param \App\Http\Requests\Backend\Access\Role\EditRoleRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\Role\EditResponse
     */
    public function edit(Role $role, ManageHrmRequest $request)
    {
        $permissions_all = $this->permissions->getAll()->toArray();

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
        if (auth()->user()->ins == $role->ins) {
            return view('focus.hrms.roles.edit',compact('permissions_all_data'))
                ->withRole($role)
                ->withRolePermissions($role->permissions->pluck('id')->all())
                ->withPermissions($this->permissions->getAll());
        }
    }

    /**
     * @param \App\Models\Access\Role\Role $role
     * @param \App\Http\Requests\Backend\Access\Role\UpdateRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Role $role, ManageHrmRequest $request)
    {
        if (auth()->user()->ins == $role->ins) $this->repository->update($role, $request->all());

        return new RedirectResponse(route('biller.role.index'), ['flash_success' => trans('alerts.backend.roles.updated')]);
    }

    /**
     * @param \App\Models\Access\Role\Role $role
     * @param \App\Http\Requests\Backend\Access\Role\DeleteRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Role $role, ManageHrmRequest $request)
    {
        if (auth()->user()->ins == $role->ins) $this->repository->delete($role);

        return new RedirectResponse(route('biller.role.index'), ['flash_success' => trans('alerts.backend.roles.deleted')]);
    }
}
