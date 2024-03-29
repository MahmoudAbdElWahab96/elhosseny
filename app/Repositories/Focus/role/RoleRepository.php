<?php

namespace App\Repositories\Focus\role;

use App\Exceptions\GeneralException;
use App\Models\Access\Role\Role;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Role::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'sort', $sort = 'asc')
    {
        return $this->query()
            ->with('users', 'permissions')
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->where('roles.status', '=', '0')
            ->where(function ($query) {
                $query->where('roles.ins', '=', auth()->user()->ins)
                    ->orWhereNull('roles.ins');
            })
            ->leftJoin('role_user', 'role_user.role_id', '=', 'roles.id')
            ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('permission_role', 'permission_role.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->select([
                'roles.id',  'roles.name', 'all',   'roles.sort', 'roles.status',  'roles.created_at', 'roles.updated_at',  'roles.ins',
                DB::raw("GROUP_CONCAT( DISTINCT rose_permissions.display_name SEPARATOR '<br/>') as permission_name"),
                DB::raw("GROUP_CONCAT( DISTINCT rose_permissions.name SEPARATOR '<br/>') as trans_name"),
                DB::raw('(SELECT COUNT(rose_role_user.id) FROM rose_role_user LEFT JOIN rose_users ON rose_role_user.user_id = rose_users.id WHERE rose_role_user.role_id = rose_roles.id AND rose_users.deleted_at IS NULL) AS userCount'),
            ])
            ->groupBy(config('access.roles_table') . '.id', config('access.roles_table') . '.name', config('access.roles_table') . '.all', config('access.roles_table') . '.sort');
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            return response()->json(['error' => trans('exceptions.backend.access.roles.already_exists')], 401);
        }

        //See if the role has all access
        $all = $input['associated_permissions'] ? true : false;

        if (!isset($input['permissions'])) {
            $input['permissions'] = [];
        }

        //This config is only required if all is false
        if (!$all) {

            //See if the role must contain a permission as per config
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                return response()->json(['error' => trans('exceptions.backend.access.roles.needs_permission')], 401);
            }
        }

        DB::transaction(function () use ($input, $all) {
            $role = self::MODEL;
            $role = new $role();
            $role->name = strip_tags($input['name']);
            $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

            //See if this role has all permissions and set the flag on the role
            $role->all = 0;

            $role->status = 0;
            $role->ins = access()->user()->ins;
            $role->created_by = access()->user()->id;

            if ($role->save()) {
                if ($all) {
                    $permissions = [];
                    if (isset($input['permission']) && is_array($input['permission']) && count($input['permission'])) {
                        foreach ($input['permission'] as $perm) {
                            if (is_numeric($perm)) {
                                array_push($permissions, $perm);
                            }
                        }
                    }

                    $role->attachPermissions($permissions);
                }

                //event(new RoleCreated($role));

                return true;
            }
            return response()->json(['error' => trans('exceptions.backend.access.roles.create_error')], 401);
        });
    }

    /**
     * @param Model $role
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($role, array $input)
    {

        if ($role->id == 1) return response()->json(['error' => trans('exceptions.backend.access.roles.update_error')], 401);
        $all = 0;

        if (!isset($input['permissions'])) {
            $input['permissions'] = [];
        }

        //This config is only required if all is false
        if (!$all) {
            //See if the role must contain a permission as per config
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                return response()->json(['error' => trans('exceptions.backend.access.roles.needs_permission')], 401);
            }
        }

        $role->name =  strip_tags($input['name']);
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

        //See if this role has all permissions and set the flag on the role
        $role->all = 0;

        $role->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $role->updated_by = access()->user()->id;

        DB::transaction(function () use ($role, $input, $all) {
            if ($role->save()) {
                //If role has all access detach all permissions because they're not needed
                if ($all) {
                    $role->permissions()->sync([]);
                } else {
                    //Remove all roles first
                    $role->permissions()->sync([]);

                    //Attach permissions if the role does not have all access
                    $permissions = [];

                    if (is_array($input['permissions']) && count($input['permissions'])) {
                        foreach ($input['permissions'] as $perm) {
                            if (is_numeric($perm)) {
                                array_push($permissions, $perm);
                            }
                        }
                    }

                    $role->attachPermissions($permissions);
                }

                // event(new RoleUpdated($role));

                return true;
            }
            return response()->json(['error' => trans('exceptions.backend.access.roles.update_error')], 401);
        });
    }

    /**
     * @param Role $role
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Role $role)
    {
        //Would be stupid to delete the administrator role
        if ($role->id == 1 or $role->id == 2) { //id is 1 because of the seeder
            return response()->json(['error' => trans('exceptions.backend.access.roles.cant_delete_admin')], 401);
        }

        //Don't delete the role is there are users associated
        if ($role->users()->count() > 0) {
            return response()->json(['error' => trans('exceptions.backend.access.roles.has_users')], 401);
        }

        DB::transaction(function () use ($role) {
            //Detach all associated roles
            $role->permissions()->sync([]);

            if ($role->delete()) {
                //  event(new RoleDeleted($role));

                return true;
            }
            return response()->json(['error' => trans('exceptions.backend.access.roles.delete_error')], 401);
        });
    }

    /**
     * @return mixed
     */
    public function getDefaultUserRole()
    {
        if (is_numeric(config('access.users.default_role'))) {
            return $this->query()->where('id', (int) config('access.users.default_role'))->first();
        }

        return $this->query()->where('name', config('access.users.default_role'))->first();
    }
}
