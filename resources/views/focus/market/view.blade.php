@extends ('core.layouts.app')

@section ('title', trans('sales_channel.sales_channel'))

@section('page-header')
<h1>
    {{ trans('sales_channel.sales_channel')}}
</h1>
@endsection

@section('content')
<div class="">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">{{ trans('labels.backend.sales_channel.view') }}</h3>

            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">

                    <div class="media-body media-right text-right">
                        @include('focus.market.partials.sales_channel-header-buttons')
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
                                        <p>{{trans('sales_channel.name')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$sales_channel['name']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('sales_channel.created_at')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p>{{$sales_channel['created_at']}}</p>
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
