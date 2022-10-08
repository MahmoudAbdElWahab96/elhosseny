@extends ('core.layouts.app')
@section ('title', trans('business.company_settings'))
@section('content')
<div class="">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h4 class="content-header-title mb-0">{{ trans('business.branch_settings') }}</h4>
            </div>
        </div>

        <div class="content-body">
            {{ Form::open(['route' => 'biller.business.add_company', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post','files' => true, 'id' => 'manage-company']) }}
            <div class="row">
                <div class="col-12">
                    <div class="card rounded">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class='form-group'>
                                        {{ Form::label( 'company', trans('hrms.company'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            <select name="method" class="form-control mb-1">
                                                <option value=""></option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->cname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'address', trans('hrms.address_1'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('address', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.address_1')]) }}
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'city', trans('hrms.city'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.city')]) }}
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'region', trans('hrms.state'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('region', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.state')]) }}
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'country', trans('hrms.country'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.country')]) }}
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'postbox', trans('hrms.postal'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('postbox', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.postal')]) }}
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'taxid', trans('hrms.tax_id'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('taxid', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.tax_id')]) }}
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        {{ Form::label( 'email', trans('general.email'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('general.email')]) }}
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        {{ Form::label( 'phone', trans('general.phone'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('general.phone')]) }}
                                        </div>
                                    </div>


                                    <div class="edit-form-btn">
                                        {{ link_to_route('biller.dashboard', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--edit-form-btn-->
                                </div>
                                <!--form-group-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


<div class="">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card rounded">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">الشركات</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="dl dl-horizontal">
                                                        <div>
                                                            <table class="table table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{ trans('hrms.company') }}</th>
                                                                        <th>{{ trans('hrms.address_1') }}</th>
                                                                        <th>{{ trans('hrms.city') }}</th>
                                                                        <th>{{ trans('hrms.state') }}</th>
                                                                        <th>{{ trans('hrms.country') }}</th>
                                                                        <th>{{ trans('hrms.postal') }}</th>
                                                                        <th>{{ trans('hrms.email') }}</th>
                                                                        <th>{{ trans('hrms.phone') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($companies as $company)
                                                                    <tr>
                                                                        <td>{{ $company->cname??'-' }}</td>
                                                                        <td>{{ $company->address??'-' }}</td>
                                                                        <td>{{ $company->city??'-' }}</td>
                                                                        <td>{{ $company->region??'-' }}</td>
                                                                        <td>{{ $company->country??'-' }}</td>
                                                                        <td>{{ $company->postbox??'-' }}</td>
                                                                        <td>{{ $company->email??'-' }}</td>
                                                                        <td>{{ $company->phone??'-' }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>



@endsection
