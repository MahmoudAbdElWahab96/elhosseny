@extends ('core.layouts.app')

@section ('title', trans('labels.backend.discounts.management') . ' | ' . trans('labels.backend.discounts.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.discounts.management') }}
        <small>{{ trans('labels.backend.discounts.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">{{ trans('labels.backend.discounts.view') }}</h3>

                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">

                        <div class="media-body media-right text-right">
                            @include('focus.discounts.partials.discounts-header-buttons')
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
                                            <p>{{trans('discounts.name')}}</p>
                                        </div>
                                        <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                            <p>{{$additional['name']}}</p>
                                        </div>
                                    </div>
                                    @if($additional['class']==1)
                                        <div class="row">
                                            <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                                <p>{{trans('discounts.value')}}</p>
                                            </div>
                                            <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                                <p>{{numberFormat($additional['value'])}}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                            <p>{{trans('discounts.class')}}</p>
                                        </div>
                                        <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                            <p>@php
                                                    switch ($additional['class']){
                                                    case 1 : echo trans('general.tax');
                                                    break;
                                                    case 2  : echo trans('general.discount');
                                                     break;
                                                    }
                                                @endphp</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                            <p>{{trans('discounts.type1')}}</p>
                                        </div>
                                        <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                            <p>@php
                                                    switch (@$additional['type1']){
                                                    case '%' : echo  '%';
                                                    break;
                                                    case 'flat' : echo  trans('discounts.flat');
                                                    break;
                                                     case 'b_flat' : echo trans('discounts.b_flat');
                                                    break;
                                                    case 'b_per' : echo  trans('discounts.b_per');
                                                    break;
                                                    }
                                                @endphp</p>
                                        </div>
                                    </div>
                                    @if($additional['class']==1)
                                        <div class="row">
                                            <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                                <p>{{trans('discounts.type2')}}</p>
                                            </div>
                                            <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                                <p>@php
                                                        switch (@$additional['type2']){
                                                        case 'inclusive' : echo  trans('discounts.inclusive');
                                                        break;
                                                         case 'exclusive' : echo trans('discounts.exclusive');
                                                        break;
                                                        }
                                                    @endphp</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                                <p>{{trans('discounts.type3')}}</p>
                                            </div>
                                            <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                                <p>@php
                                                        switch (@$additional['type3']){
                                                        case 'inclusive' : echo  trans('discounts.inclusive');
                                                        break;
                                                         case 'exclusive' : echo trans('discounts.exclusive');
                                                        break;
                                                         case 'cgst' : echo trans('discounts.cgst');
                                                        break;
                                                             case 'igst' : echo trans('discounts.igst');
                                                        break;
                                                        }
                                                    @endphp</p>
                                            </div>
                                        </div>
                                    @endif


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
