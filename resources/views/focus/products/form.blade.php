<div class="form-group">

    <div class='col-lg-10'>
        {{trans('products.general_product_details')}}
    </div>
</div>


<div class="row">
{{--    <div class="col-md-4">--}}
{{--        <div class='form-group'>--}}
{{--            {{ Form::label( 'code', trans('products.code'),['class' => 'col control-label']) }}--}}
{{--            <div class='col'>--}}
{{--                {{ Form::text('code', @$products->code, ['class' => 'form-control box-size', 'placeholder' => trans('products.code').'*','required'=>'required']) }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-md-4">
        <div class='form-group'>
            {{ Form::label( 'code', trans('products.code'),['class' => 'col control-label']) }}
            <div class='col'>
                @if( $product_code && $product_code->is_require == 1)
                    {{ Form::text('code', @$products->standard['code'], ['class' => 'form-control box-size', 'placeholder' => trans('products.code').'*','required'=>'required']) }}
                @else
                    {{ Form::text('code', @$products->standard['code'], ['class' => 'form-control box-size', 'placeholder' => trans('products.code')]) }}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class='form-group'>
            {{ Form::label( 'gs_code', trans('products.gs_code'),['class' => 'col control-label']) }}
            <div class='col'>
                @if( $product_gs_code && $product_gs_code->is_require == 1)
                    {{ Form::text('gs_code', @$products->gs_code, ['class' => 'form-control box-size', 'placeholder' => trans('products.gs_code').'*','required'=>'required']) }}
                @else
                    {{ Form::text('gs_code', @$products->gs_code, ['class' => 'form-control box-size', 'placeholder' => trans('products.gs_code')]) }}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class='form-group'>
            {{ Form::label( 'egs_code', trans('products.egs_code'),['class' => 'col control-label']) }}
            <div class='col'>
                @if( $product_egs_code && $product_egs_code->is_require == 1)
                    {{ Form::text('egs_code', @$products->name, ['class' => 'form-control box-size', 'placeholder' => trans('products.egs_code').'*','required'=>'required']) }}
                @else
                    {{ Form::text('egs_code', @$products->name, ['class' => 'form-control box-size', 'placeholder' => trans('products.egs_code')]) }}
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">

        <div class='form-group'>
            {{ Form::label( 'name', trans('products.name'),['class' => 'col control-label']) }}
            <div class='col'>
                @if( $product_name && $product_name->is_require == 1)
                    {{ Form::text('name', @$products->name, ['class' => 'form-control box-size', 'placeholder' => trans('products.name').'*','required'=>'required']) }}
                @else
                    {{ Form::text('name', @$products->name, ['class' => 'form-control box-size', 'placeholder' => trans('products.name')]) }}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class='form-group'>
            {{ Form::label( 'taxrate', trans('products.taxrate'),['class' => 'col control-label']) }}
            <div class='col'>
                {{ Form::text('taxrate', numberFormat(@$products['taxrate']), ['class' => 'form-control box-size', 'placeholder' => trans('products.taxrate'),'onkeypress'=>"return isNumber(event)"]) }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class='form-group'>
            {{ Form::label( 'product_des', trans('products.product_des'),['class' => 'col control-label']) }}
            <div class='col'>
                {{ Form::textarea('product_des', null, ['class' => 'form-control box-size', 'rows'=>2, 'placeholder' => trans('products.product_des')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class='form-group'>
            {{ Form::label( 'code_type', trans('products.code_type'),['class' => 'col control-label']) }}
            <div class='col'>
                <select class="form-control" name="code_type">
                    @if(@$products->code_type)
                        <option value="{{$products->code_type}}" selected>{{$products->code_type}}</option>
                    @endif
                    <option value="EAN13">EAN13 - Default</option>
                    <option value="UPCA">UPC</option>
                    <option value="EAN8">EAN8</option>
                    <option value="ISSN">ISSN</option>
                    <option value="ISBN">ISBN</option>
                    <option value="C128A">C128A</option>
                    <option value="C39">C39</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label( 'unit', trans('products.stock_type'),['class' => 'col control-label']) }}
            <div class='col'>
                <select class="form-control" name="stock_type" id="product_stock_type" onchange="change_product_stock()">
                    <option value="1" {{@$products->stock_type===1 ? 'selected' : ''}}>{{trans('products.material')}}</option>
                    <option value="0" {{@$products->stock_type===0 ? 'selected' : ''}}>{{trans('products.service')}}</option>
                    <option value="2" {{@$products->stock_type===2 ? 'selected' : ''}}>{{trans('products.full')}}</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label( 'productcategory_id', trans('products.productcategory_id'),['class' => 'col control-label']) }}
            <div class='col'>
                <select class="form-control" name="productcategory_id" id="product_cat">
                    @foreach($product_category as $item)
                        @if(!$item->c_type)
                            <option value="{{$item->id}}" {{ $item->id === @$products->productcategory_id ? " selected" : "" }}>{{$item->title}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label( 'sub_cat_id', trans('products.sub_cat_id'),['class' => 'col control-label']) }}
            <div class='col'>
                <select class="form-control" name="sub_cat_id" id="sub_cat">
                    <option value="0">--{{ trans('products.sub_cat_id')}}--</option>
                    @foreach($product_category as $item)
                        @if($item->c_type AND $product_category->first()['id']==$item->rel_id)
                            <option value="{{$item->id}}" {{ $item->id === @$products->productcategory_id ? " selected" : "" }}>{{$item->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label( 'unit', trans('products.unit'),['class' => 'col control-label']) }}
            <div class='col'>
                <select class="form-control" name="unit">
                    @foreach($product_variable as $item)
                        @if(!$item->type)
                            <option value="{{$item->code}}" {{ $item->code === @$products->unit ? " selected" : "" }}>{{$item->name}}
                                - {{$item->code}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>


<!-- <hr class="mb-5">
<div class="row product_content" style="{{@$products->stock_type !==2 ? 'display: none' : ''}}">
    <div class='col-md-12'>
        <div class="row">
            <div class="col-md-6">
                <p>{{trans('products.content')}}</p>
            </div>
            <div class="col-md-6" onclick='addNewContent()'>
                <button type="button" class="btn btn-primary">{{trans('general.add')}}</button>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="product_content">
        @if(@$products->stock_type == 2)
            @foreach ($products->contains as $item)
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label for='content_id'>{{trans('products.name')}}</label>
                        <select class='form-control products select-box' name='content_id'>
                            <option value=''>Select product</option>
                            @foreach ($productVariation as $product)
                                <option value='{{$product->product_id}}' {{$item->contain_id == $product->product_id ? 'selected' : ''}}>{{$product->product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='col control-label'>{{trans('products.qty')}}</label>
                        <input type='text' value='{{$item->qty}}' name='content_qty' class='form-control box-size'>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <hr class="mb-5">
</div> -->

<div class="row">
    <div class='col-lg-10'>
        {{trans('products.product_type')}}
    </div>
</div>

<div class="row">
    <div class='col-lg-10'>
        <select class="form-control" name="type" id="product_type" onchange="getProductValue(this);">
            <option value=""></option>
            <option value="normal"> عادي</option>
            <option value="variable"> متغير</option>
        </select>
    </div>
</div>
<br/><br/>
<div id="main_product" style="display: none;">
    <div class="product round">
        <div class="row" id="variable_product" style="display:none;">
            @foreach($productVariables as $key => $productVariable)
                <div class="col-md-4">
                    <div class='form-group'>
                        {{ Form::label( 'price', $productVariable->name ,['class' => 'col control-label']) }}
                        <div class='col'>
                            <select class="form-control" name="product_variable_value_id[]">
                                <option value=""></option>
                                @foreach($productVariable->variationValues as $item)
                                    <option value="{{$item->id}}">{{$item->value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach    
        </div>

        <div class="row mt-1 mb-1">
            <div class="col-md-12">
                <div class='form-group'>
                    {{ Form::label( 'variation_name', trans('general.description'),['class' => 'col control-label']) }}
                    <div class='col-6'>
                        {{ Form::text('variation_name',@$products->standard['name'], ['class' => 'form-control box-size', 'placeholder' => trans('general.description')]) }}
                    </div>

                </div>
            </div>
            <div class="old_id"><input
                        type="hidden" name="v_id" value="{{@$products->standard['id']}}"><input
                        type="hidden" name="pv_id" value="{{@$products->standard['id']}}"></div>


        </div>
        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'price', trans('products.price'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('price', numberFormat(@$products->standard['price']), ['class' => 'form-control box-size', 'placeholder' => trans('products.price').'*','required'=>'required','onkeypress'=>"return isNumber(event)"]) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'purchase_price', trans('products.purchase_price'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('purchase_price', numberFormat(@$products->standard['purchase_price']), ['class' => 'form-control box-size', 'placeholder' => trans('products.purchase_price'),'onkeypress'=>"return isNumber(event)"]) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'qty', trans('products.qty'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('qty', numberFormat(@$products->standard['qty']), ['class' => 'form-control box-size', 'placeholder' => trans('products.qty'),'onkeypress'=>"return isNumber(event)"]) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label( 'productcategory_id', trans('products.warehouse_id'),['class' => 'col control-label']) }}
                    <div class='col'>
                        <select class="form-control" name="warehouse_id">

                            @foreach($warehouses as $item)
                                <option value="{{$item->id}}" {{ $item->id === @$products->warehouse_id ? " selected" : "" }}>{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'barcode', trans('products.barcode'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('barcode', @$products->standard['barcode'], ['class' => 'form-control box-size', 'placeholder' => trans('products.barcode')]) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'disrate', trans('products.disrate'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('disrate', numberFormat(@$products->standard['disrate']), ['class' => 'form-control box-size', 'placeholder' => trans('products.disrate'),'onkeypress'=>"return isNumber(event)"]) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'alert', trans('products.alert'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('alert', numberFormat(@$products->standard['alert']), ['class' => 'form-control box-size', 'placeholder' => trans('products.alert'),'onkeypress'=>"return isNumber(event)"]) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class='form-group'>
                    {{ Form::label( 'expiry', trans('products.expiry'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {{ Form::text('expiry', dateFormat(@$products->standard['expiry']), ['class' => 'form-control box-size', 'placeholder' => trans('products.expiry'),'data-toggle'=>'datepicker','autocomplete'=>'false']) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class='form-group'>
                    {{ Form::label( 'image', trans('products.image'),['class' => 'col control-label']) }}
                    <div class='col'>
                        {!! Form::file('image', array('class'=>'input' )) !!}
                    </div>
                </div>
            </div>
        </div>
        <span class="col-6 del_b"></span>
        <hr>
    </div>
</div>

@section("after-styles")
    <style>
        #added_product div:nth-child(even) .product {
            background: #FFF
        }

        #added_product div:nth-child(odd) .product {
            background: #eeeeee
        }

        #product_sub div:nth-child(odd) .v_product_t {
            background: #FFF
        }

        #product_sub div:nth-child(even) .v_product_t {
            background: #eeeeee
        }
    </style>
    {!! Html::style('focus/css/select2.min.css') !!}
@endsection
@section("after-scripts")
{{ Html::script('focus/js/select2.min.js') }}

    <script type="text/javascript">
        $(".products").select2();
        function addNewContent() {
            $("#product_content").append("<div class='col-md-12'><div class='form-group'><label for='content_id'>{{trans('products.name')}}</label><select class='form-control products' name='content_id'><option value=''>Select product</option>@foreach ($productVariation as $product)<option value='{{$product->product_id}}'>{{$product->product->name}}</option>@endforeach</select></div></div><div class='col-md-12'><div class='form-group'><label class='col control-label'>{{trans('products.qty')}}</label><input type='text' value='1' name='content_qty' class='form-control box-size'></div></div>");
            $('.products').select2();
        }
        function change_product_stock() {
            var product_stock_type=$("#product_stock_type").val();
            if(product_stock_type == 2)
            {
                addNewContent();
                $(".product_content").append('<hr class="mb-5">');
                $(".product_content").show();
            }
            else
            {
                $("#product_content").html("");
                $(".product_content").hide();
            }

        }
        $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            format: '{{config('core.user_date_format')}}'
        });

        $(document).on('click', ".add_serial", function (e) {
            e.preventDefault();

            $('#added_product').append('<div class="form-group serial"><label for="field_s" class="col-lg-2 control-label">{{trans('products.product_serial')}}</label><div class="col-lg-10"><input class="form-control box-size" placeholder="{{trans('products.product_serial')}}" name="product_serial" type="text"  value=""></div><button class="btn-sm btn-purple v_delete_serial m-1 align-content-end"><i class="fa fa-trash"></i> </button></div>');

        });

        function getProductValue(sel){

            if(sel.value == 'normal'){
                $('#main_product').css('display', 'block');
                $('#variable_product').css('display', 'none');
            }else if(sel.value == 'variable'){
                $('#variable_product').css('display', 'block');
            }
        }

    </script>
    {{ Html::script('focus/js/select2.min.js') }}
    <script type="text/javascript">
        $("#sub_cat").select2();
        $("#product_cat").on('change', function () {
            $("#sub_cat").val('').trigger('change');
            var tips = $('#product_cat :selected').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#sub_cat").select2({
                ajax: {
                    url: '{{route('biller.products.product_sub_load')}}?id=' + tips,
                    dataType: 'json',
                    type: 'POST',
                    quietMillis: 50,
                    params: {'cat_id': tips},
                    data: function (product) {
                        return {
                            product: product
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.title,
                                    id: item.id
                                }
                            })
                        };
                    },
                }
            });
        });
    </script>
@endsection
