@extends ('core.layouts.app')
@section ('title', trans('business.settings'))
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<style>
    .fancy-forms .tab-content {
        background: #ffffff;
        color: #ffffff;
        padding: 10px;
        box-shadow: 8px 12px 25px 2px rgba(0, 0, 0, 0.3);
    }

    .fancy-forms .nav-tabs .nav-item {
        text-align: center;
    }

    .fancy-forms .nav-tabs .nav-link {

        border: 1px solid #e47a4b;
        background-color: #e47a4b;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        color: #ffffff;
        box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.3);
    }

    .fancy-forms .nav-tabs .nav-link.active {
        border-color: #fff;
        color: #e47a4b;
        background-color: #ffffff;
    }

    .fancy-forms .nav-tabs .nav-link:hover {
        border-color: #fff;
    }

    fancy-forms .nav-tabs .nav-link.active:hover {
        border-color: #e47a4b;
    }

    .fancyformcontainer {
        background: #e6c3b4;
        padding: .5rem 3rem !important;
        margin: 3rem !important;
    }

    .formsubmitbtn {
        background: #e47a4b;
        color: white;
        margin-bottom: 1.5rem !important;
    }

    .formsubmitbtn:hover,
    .formsubmitbtn:focus {
        color: #fff;
    }

    .choices__list--dropdown{
        display: none;
        z-index: 1;
        position: absolute;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ddd;
        top: 100%;
        margin-top: -1px;
        border-bottom-left-radius: 2.5px;
        border-bottom-right-radius: 2.5px;
        overflow: hidden;
        word-break: break-all;
        color: black;
    }

</style>
<div class="">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h4 class="content-header-title mb-0">{{ trans('business.settings') }}</h4>

            </div>

        </div>

        <div class="content-body">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 mt-5 fancy-forms">
                            <ul class="nav nav-tabs  mt-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="product" data-toggle="tab" href="#product_form" role="tab" aria-controls="product" aria-selected="true">Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="customer" data-toggle="tab" href="#customer_form" role="tab" aria-controls="client" aria-selected="false">Customer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orderedSupply" data-toggle="tab" href="#orderedSupply_form" role="tab" aria-controls="orderedSupply" aria-selected="false">OrderedSupply</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account" data-toggle="tab" href="#account_form" role="tab" aria-controls="account" aria-selected="false">Account</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="product_form" role="tabpanel" aria-labelledby="product">
                                    <div class="fancyformcontainer">
                                        <h3 class="text-center">Product</h3>
                                        {{ Form::open(['route' => ['biller.settings.product'], 'class' => 'form-horizontal', 'method' => 'post']) }}
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $product_code = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\product\Product::class)->where('field','code')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($product_code))
                                                        {{ Form::checkbox('code',1,true) }} {{ trans('products.code') }}
                                                        @else
                                                        {{ Form::checkbox('code') }} {{ trans('products.code') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $product_gs_code = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\product\Product::class)->where('field','gs_code')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($product_gs_code))
                                                        {{ Form::checkbox('gs_code',1,true) }} {{ trans('products.gs_code') }}
                                                        @else
                                                        {{ Form::checkbox('gs_code') }} {{ trans('products.gs_code') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $product_egs_code = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\product\Product::class)->where('field','egs_code')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($product_egs_code))
                                                        {{ Form::checkbox('egs_code',1,true) }} {{ trans('products.egs_code') }}
                                                        @else
                                                        {{ Form::checkbox('egs_code') }} {{ trans('products.egs_code') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $product_name = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\product\Product::class)->where('field','name')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($product_name))
                                                        {{ Form::checkbox('name',1,true) }} {{ trans('products.name') }}
                                                        @else
                                                        {{ Form::checkbox('name') }} {{ trans('products.name') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->

                                        <div class="text-center">
                                            <button type="submit" class="btn formsubmitbtn">Submit</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="customer_form" role="tabpanel" aria-labelledby="customer">
                                    <div class="fancyformcontainer">
                                        <h3 class="text-center">OrderedSupply</h3>
                                        {{ Form::open(['route' => ['biller.settings.customer'], 'class' => 'form-horizontal', 'method' => 'post']) }}
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $customer_name = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\customer\Customer::class)->where('field','name')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($customer_name))
                                                        {{ Form::checkbox('name',1,true) }} {{ trans('customers.name') }}
                                                        @else
                                                        {{ Form::checkbox('name') }} {{ trans('customers.name') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $customer_phone = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\customer\Customer::class)->where('field','phone')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($customer_phone))
                                                        {{ Form::checkbox('phone',1,true) }} {{ trans('customers.phone') }}
                                                        @else
                                                        {{ Form::checkbox('phone') }} {{ trans('customers.phone') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $customer_email = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\customer\Customer::class)->where('field','email')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($customer_email))
                                                        {{ Form::checkbox('email',1,true) }} {{ trans('customers.email') }}
                                                        @else
                                                        {{ Form::checkbox('email') }} {{ trans('customers.email') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="text-center">
                                            <button type="submit" class="btn formsubmitbtn">Submit</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="orderedSupply_form" role="tabpanel" aria-labelledby="orderedSupply">
                                    <div class="fancyformcontainer">
                                        <h3 class="text-center">OrderedSupply</h3>
                                        {{ Form::open(['route' => ['biller.settings.orderedSupply'], 'class' => 'form-horizontal', 'method' => 'post']) }}
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <label>
                                                        @php
                                                        $orderedSupply_show = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\orderedSupply\OrderedSupply::class)->where('field','show')->where('is_require', 1)->first();
                                                        @endphp
                                                        @if(!is_null($orderedSupply_show))
                                                        {{ Form::checkbox('show',1,true) }} {{ trans('orderedSupply.show') }}
                                                        @else
                                                        {{ Form::checkbox('show') }} {{ trans('orderedSupply.show') }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="text-center">
                                            <button type="submit" class="btn formsubmitbtn">Submit</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="account_form" role="tabpanel" aria-labelledby="account">
                                    <div class="fancyformcontainer">
                                        <h3 class="text-center">Account</h3>
                                        {{ Form::open(['route' => ['biller.settings.account'], 'class' => 'form-horizontal', 'method' => 'post']) }}

                                        @php
                                            $ids = [];
                                            $account_ids = \App\Models\settings\SettingsRequiredFields::where('model_type', App\Models\account\Account::class)->where('field','account_id')->select(['is_require'])->get()->toArray();
                                            foreach($account_ids as $id){
                                                array_push($ids,$id['is_require']);
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <div class="col">
                                                <div class="checkbox">
                                                    <select id="account_id" name="account_id[]" multiple>
                                                        <option value="">قم باختيار الحساب</option>
                                                        @if(@$accounts)
                                                            @foreach($accounts as $account)
                                                            <option value="{{$account->id}}"
                                                             {{ array_search($account->id,$ids)?'selected':'' }}>{{$account->number .'-'. $account->holder}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <!--col-md-6-->
                                        </div>
                                        <!--form-group-->
                                        <div class="text-center">
                                            <button type="submit" class="btn formsubmitbtn">Submit</button>
                                        </div>
                                        {{ Form::close() }}
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

@section("after-scripts")
<script type="text/javascript">
    $(document).ready(function() {

        var multipleCancelButton = new Choices('#account_id', {
            removeItemButton: true,
        });
    });
</script>
@endsection
