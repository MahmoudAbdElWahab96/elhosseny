<div class="row p-1">
    @if(access()->allow('manage-hrm'))
        @foreach($permissions_all_data as $key => $permissions)
            <div class="col-md-12" >
                <span style="font-weight: bold;
                    background-color: #42a3ca;
                    padding: 10px;
                    border-radius: 4px;
                    color: white;
                    font-size: 17px;">
                    {{$key}}
                </span>
            </div>
            <?php $rolePermissions = $role->permissions->pluck('id')->all(); ?>
            <div class="row" style="border: 1px solid;
                border-radius: 25px;
                padding: 8px;
                margin: 15px;background: #a5eaff;">
                @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox">
                                <input class="icheckbox_square icheckbox_flat-blue"
                                    type="checkbox"
                                    name="permissions[{{ $permission[0]['id'] }}]"
                                    value="{{ $permission[0]['id'] }}"
                                    id="perm_{{ $permission[0]['id'] }}" {{ in_array($permission[0]['id'], $rolePermissions) ? 'checked' : '' }} />
                                    <label for="perm_{{ $permission[0]['id'] }}">{{ trans('permissions.'.$permission[0]['name']) }}</label>
                            </div>
                        </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>

