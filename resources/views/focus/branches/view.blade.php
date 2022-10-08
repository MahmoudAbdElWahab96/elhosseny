@extends ('core.layouts.app')

@section ('title', trans('labels.backend.branches.management') . ' | ' . trans('labels.backend.branches.create'))

@section('page-header')
<h1>
    {{ trans('labels.backend.branches.management') }}
    <small>{{ trans('labels.backend.branches.create') }}</small>
</h1>
@endsection

@section('content')
<div class="">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="mb-0">{{ trans('labels.backend.branches.view') }}</h3>

            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">

                    <div class="media-body media-right text-right">
                        @include('focus.branches.partials.branches-header-buttons')
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
                                        <p>{{trans('branches.name')}} </p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p> {{$branch['name']}} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{ trans('branches.country') }} *</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p> {{ $branch->country }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('branches.region')}} </p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p> {{ $branch->city }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('branches.postbox')}}</p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p> {{$branch->postbox }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('branches.phone')}} </p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p> {{$branch->phone}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 border-blue-grey border-lighten-5  p-1">
                                        <p>{{trans('branches.email')}} </p>
                                    </div>
                                    <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                                        <p> {{$branch->email}}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <small>* referred to account balance in single entry system.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
