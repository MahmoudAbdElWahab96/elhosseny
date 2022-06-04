@extends ('core.layouts.app')

@section ('title', trans('labels.backend.taxes.management') . ' | ' . trans('labels.backend.taxes.create'))

@section('page-header')
<h1>
    {{ trans('labels.backend.taxes.management') }}
    <small>{{ trans('labels.backend.taxes.create') }}</small>
</h1>
@endsection

@section('content')
<div class="">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">{{ trans('labels.backend.taxes.view') }}</h3>

            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">

                    <div class="media-body media-right text-right">
                        @include('focus.taxes.partials.taxes-header-buttons')
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
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('taxes.Desc_en')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$tax['Desc_en']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('taxes.Desc_ar')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$tax['Desc_ar']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('taxes.code')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$tax['code']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <h3> الضرايب الفرعيه</h3>
                                    <table id="countries-table"
                                           class="table table-striped table-bordered zero-configuration" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('additionals.code') }}</th>
                                            <th>{{ trans('additionals.name') }}</th>
                                            <th>{{ trans('additionals.name_en') }}</th>
                                            <th>{{ trans('additionals.value') }}</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($additionals as $additional)
                                            <tr>
                                                <td>{{ $additional->id }}</td>
                                                <td>{{ $additional->code }}</td>
                                                <td>{{ $additional->name }}</td>
                                                <td>{{ $additional->name_en }}</td>
                                                <td>{{ $additional->value }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                <!-- <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('taxes.Desc_ar')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$tax['Desc_ar']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('taxes.code')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$tax['code']}}</p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
