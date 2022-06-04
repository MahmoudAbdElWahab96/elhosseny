@extends ('core.layouts.app')

@section ('title', trans('labels.backend.hrms.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.access.roles.management') }}</h1>
@endsection

@section('content')

    <div class="">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h4 class="content-header-title mb-0">{{ trans('labels.backend.access.roles.management') }}</h4>

                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">

                        <div class="media-body media-right text-right">
                            @include('focus.hrms.partials.role-header-buttons')
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content">

                                <div class="card-body">
                                    {{ Form::open(['route' => 'biller.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) }}

                                    <div class="box box-info">


                                        <div class="box-body">
                                            <div class="form-group">
                                                {{ Form::label('name', trans('validation.attributes.backend.access.roles.name'), ['class' => 'col-lg-2 control-label required']) }}

                                                <div class="col-lg-10">
                                                    {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.roles.name'), 'required' => 'required']) }}
                                                </div><!--col-lg-10-->
                                            </div><!--form control-->

                                            <div class="form-group">
                                                {{ Form::label('associated_permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-lg-2 control-label']) }}

                                                <div class="col-lg-10">
                                                    {{ Form::select('associated_permissions', array('none' => trans('meta.select'), 'custom' => trans('hrms.permissions')), 'none', ['class' => 'form-control select2 box-size']) }}

                                                    <div id="available-permissions" class="hidden mt-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                @if (@$permissions->count())
                                                                    @foreach ($permissions_all_data as $key => $permissions)
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
                                                                        <div class="row" style="border: 1px solid;
                                                                            border-radius: 25px;
                                                                            padding: 8px;
                                                                            margin: 15px;background: #a5eaff;">
                                                                            @foreach($permissions as $permission)
                                                                                    <div class="col-md-4">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" name="permission[]" value="{{$permission[0]['id']}}" >
                                                                                            <label>{{trans('permissions.'.$permission[0]['name'])}}</label>
                                                                                        </div>
                                                                                    </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <br/>
                                                                    @endforeach
                                                                @else
                                                                    <p>There are no available permissions.</p>
                                                                @endif
                                                            </div><!--col-lg-6-->
                                                        </div><!--row-->
                                                    </div><!--available permissions-->
                                                </div><!--col-lg-3-->
                                            </div><!--form control-->


                                            <div class="form-group">
                                                {{ Form::label('status', trans('validation.attributes.backend.access.roles.active'), ['class' => 'col-lg-2 control-label']) }}

                                                <div class="col-lg-10">
                                                    <div class="control-group">
                                                        <label class="control control--checkbox">
                                                            {{ Form::checkbox('status', 1, true) }}
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                    </div>
                                                </div><!--col-lg-3-->
                                            </div><!--form control-->
                                            <div class="edit-form-btn">
                                                {{ link_to_route('biller.role.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                                                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                                                <div class="clearfix"></div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div><!--box-->
                                    {{ Form::close() }}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    {{ Html::script('js/backend/access/roles/script.js') }}
    <script type="text/javascript">
        // Backend.Utils.documentReady(function(){
        //    Backend.Roles.init("rolecreate")
        // });
    </script>
@endsection
