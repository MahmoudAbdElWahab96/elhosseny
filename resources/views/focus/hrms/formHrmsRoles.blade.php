<div class="card-content">
    <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" role="tab"
                   aria-selected="true">{{trans('hrms.employee_details')}}</a>
            </li>
        </ul>
        <div class="tab-content px-1 pt-1">
            <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="base-tab1">

                <div class='form-group'>
                    {{ Form::label( 'hrms', trans('hrms.users'),['class' => 'col-lg-2 control-label']) }}
                    <div class='col-lg-10'>
                        <select class="form-control" name="user_id" id="user_id">
                            @foreach(@$users AS $user)
                                <option value="{{$user->id}}">{{$user->first_name. '' . $user->last_name .'('. ($user->increment??'#').')'}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class='form-group'>
                    {{ Form::label( 'role', trans('hrms.role'),['class' => 'col-lg-2 control-label']) }}
                    <div class='col-lg-10'>
                        <select class="form-control" name="role"
                                id="{{ $general['create'] == 1 ? "new_emp_role" : "emp_role" }}">
                            @foreach($roles AS $role)
                                <option value="{{$role['id']}}"
                                        @if(@$hrms->role['id']==$role['id']) selected @endif>{{$role['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="permission_result">
                        @if(@$hrms->role['id'])
                            <div class="row p-1">
                                @foreach($permissions_all_data as $permissions)
                                    @foreach($permissions as $key => $permission)
                                        <div class="col-md-6">
                                            <span style="font-weight: bold;">{{$key}}</span>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="permission[]" value="{{$permission['id']}}"
                                                    @if(in_array_r($permission['id'],@$permissions)) checked="checked" @endif>
                                                <label>{{trans('permissions.'.$permission['name'])}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('after-scripts')
    {{ Html::script('focus/js/jquery.password-validation.js') }}
    <script>

        $(document.body).on('change', '#emp_role', function (e) {
            var pid = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("biller.hrms.related_permission") }}',
                type: 'post',
                dataType: 'html',
                data: {'rid': pid, 'create': '{{$general['create']}}'},
                success: function (data) {
                    $('#permission_result').html(data)
                }
            });
        });
        $(document.body).on('change', '#new_emp_role', function (e) {
            var pid = $(this).val();
            fresh_permission(pid);
        });

        function fresh_permission(pid = 1) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("biller.hrms.role_permission") }}',
                type: 'post',
                dataType: 'html',
                data: {'rid': pid, 'create': '{{$general['create']}}'},
                success: function (data) {
                    $('#permission_result').html(data)
                }
            });
        }

        @if(isset($hrms->role['id']))  fresh_permission({{$hrms->role['id']}});
        @else fresh_permission(2); @endif
    </script>
@endsection
