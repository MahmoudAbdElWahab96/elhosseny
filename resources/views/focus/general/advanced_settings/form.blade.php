<div class="card-content">
    <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" role="tab"
                   aria-selected="true">{{trans('customers.billing_address')}}</a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" role="tab"--}}
{{--                   aria-selected="false">{{trans('customers.shipping_address')}}</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" role="tab"--}}
{{--                   aria-selected="false">{{trans('general.other')}}</a>--}}
{{--            </li>--}}

        </ul>
        <div class="tab-content px-1">
            <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                <div class="row">
                    <div class="col-sm-6">
                        <div class='form-group'>
                            {{ Form::label( 'code', trans('customers.code'),['class' => 'col-lg-2 control-label']) }}
                            <div class='col-md-12'>
                                {{ Form::checkbox('code', 1 , true) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class='form-group'>
                            {{ Form::label( 'phone', trans('customers.phone'),['class' => 'col-lg-6 control-label']) }}
                            <div class='col-md-12'>
                                {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('customers.phone').'*','required'=>'required']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section("after-scripts")
    <script type="text/javascript">

    </script>
@endsection
