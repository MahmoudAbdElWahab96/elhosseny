@extends ('core.layouts.app')
@section ('title', trans('business.company_settings'))
@section('content')
<div class="">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h4 class="content-header-title mb-0">{{ trans('business.company_settings') }}</h4>
                <a href="{{ route('biller.branches.create')}}" type="button" id="add_branch" class="btn btn-blue" >{{trans('branches.add_branch')}}
                </a>
            </div>
        </div>

        <div class="content-body">
            {{ Form::open(['route' => 'biller.business.add_company', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post','files' => true, 'id' => 'manage-company']) }}
            <div class="row">
                <div class="col-6">
                    <div class="card rounded">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class='form-group'>
                                        {{ Form::label( 'cname', trans('hrms.company'),['class' => 'col control-label']) }}
                                        <div class='col'>
                                            {{ Form::text('cname', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.company')]) }}
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

                                    <div class="row form-group">
                                        <div class="col-12">{!! $fields_data !!}</div>
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
                                                                        <th>{{ trans('hrms.actions') }}</th>
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
                                                                        <td>
                                                                            <a href="{{ route('biller.business.update_settings', $company->id) }}" class="btn btn-warning round" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                                <i class="fa fa-pencil "></i>
                                                                            </a>
                                                                            <form method="POST" action="{{ route('biller.business.delete_company', $company->id) }}">
                                                                                <button type="submit" class="btn btn-danger round">
                                                                                        <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                        </td>
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
        </div>
    </div>
</div>



@endsection
