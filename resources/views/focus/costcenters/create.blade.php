@extends ('core.layouts.app')

@section ('title', trans('labels.backend.costcenters.management') . ' | ' . trans('labels.backend.costcenters.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.costcenters.management') }}
        <small>{{ trans('labels.backend.costcenters.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h4 class="content-header-title mb-0">{{ trans('labels.backend.costcenters.create') }}</h4>

                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">

                        <div class="media-body media-right text-right">
                            @include('focus.costcenters.partials.costcenters-header-buttons')
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content">
                                <h1>
                                    {{ trans('costcenters.screen') }} :
                                    {{ $screen['name_' . app()->getLocale()] }}
                                </h1>
                                <div class="card-body">
                                    {{ Form::open(['route' => 'biller.costcenters.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-bank']) }}


                                    <div class="form-group">
                                        {{-- Including Form blade file --}}
                                        @include("focus.costcenters.form")
                                        <div class="edit-form-btn">
                                            {{ link_to_route('biller.costcenters.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                                            {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                                            <div class="clearfix"></div>
                                        </div><!--edit-form-btn-->
                                    </div><!-- form-group -->

                                    {{ Form::close() }}
                                    <table id="costcenters-table"
                                           class="table table-striped table-bordered zero-configuration" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{!! trans('costcenters.name_en') !!} </th>
                                            <th>{!! trans('costcenters.name_ar') !!} </th>
                                            <th>{!! trans('costcenters.cost_balance') !!} </th>
                                            <th>{!! trans('costcenters.code') !!} </th>
                                            {{--                                            <th>{!! trans('costcenters.type') !!} </th>--}}
                                            <th>{{ trans('labels.general.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

