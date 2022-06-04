@extends ('core.layouts.app')

@section ('title', trans('labels.backend.purchaseorders.management') . ' | ' . trans('labels.backend.purchaseorders.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.purchaseorders.management') }}
        <small>{{ trans('labels.backend.purchaseorders.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" id="data_form">
                                <div class="row">
                                    <div class="col-sm-6 cmp-pnl">
                                        <div id="customerpanel" class="inner-cmp-pnl">
                                            <div class="form-group row">
                                                <div class="fcol-sm-12">
                                                    <h3 class="title">{{trans('purchaseorders.bill_from')}} <a href='#'
                                                                                                               class="btn btn-primary btn-sm round"
                                                                                                               data-toggle="modal"
                                                                                                               data-target="#addCustomer">
                                                            {{trans('purchaseorders.add_supplier')}}
                                                        </a>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="frmSearch col-sm-12">
                                                    {{ Form::label( 'cst', trans('purchaseorders.search_supplier'),['class' => 'caption']) }}
                                                    {{ Form::text('cst', null, ['class' => 'form-control round user-box', 'placeholder' =>trans('purchaseorders.supplier_search'), 'id'=>'suppliers-box','data-section'=>'suppliers','autocomplete'=>'off']) }}
                                                    <div id="suppliers-box-result"></div>
                                                </div>
                                            </div>
                                            <div id="customer">
                                                <div class="clientinfo">{{trans('purchaseorders.supplier_details')}}
                                                    <hr>
                                                    <div id="customer_name"></div>
                                                </div>
                                                <div class="clientinfo">
                                                    <div id="customer_address1"></div>
                                                </div>
                                                <div class="clientinfo">
                                                    <div id="customer_phone"></div>
                                                </div>
                                                <hr>
                                                <div id="customer_pass"></div>
                                                <hr>
                                            </div>{{trans('warehouses.warehouse')}}<select
                                                    id="s_warehouses"
                                                    class="form-control round mt-1">
                                                <option value="0">{{trans('general.all')}}</option>
                                                @foreach($warehouses as $warehouse)
                                                    <option value="{{$warehouse->id}}" {{$warehouse->id==@$defaults[1][0]['feature_value'] ? 'selected' : ''}}>{{$warehouse->title}}</option>
                                                @endforeach
                                            </select>

                                            {{ Form::hidden('supplier_id', '0',['id'=>'customer_id']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 cmp-pnl">
                                        <div class="inner-cmp-pnl">


                                            <div class="form-group row">

                                                <div class="col-sm-12"><h3
                                                            class="title">{{trans('purchaseorders.properties')}}</h3>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6"><label for="invocieno"
                                                                             class="caption">{{trans('purchaseorders.tid')}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="icon-file-text-o"
                                                                                             aria-hidden="true"></span>
                                                        </div>

                                                        {{ Form::number('tid', @$last_invoice->tid+1, ['class' => 'form-control round', 'placeholder' => trans('purchaseorders.tid')]) }}
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><label for="invocieno"
                                                                             class="caption">{{trans('general.reference')}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="icon-bookmark-o"
                                                                                             aria-hidden="true"></span>
                                                        </div>
                                                        {{ Form::text('refer', null, ['class' => 'form-control round', 'placeholder' => trans('general.reference')]) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-6"><label for="invociedate"
                                                                             class="caption">{{trans('purchaseorders.invoicedate')}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="icon-calendar4"
                                                                                             aria-hidden="true"></span>
                                                        </div>
                                                        {{ Form::text('invoicedate', null, ['class' => 'form-control round required', 'placeholder' => trans('purchaseorders.invoicedate'),'data-toggle'=>'datepicker','autocomplete'=>'false']) }}
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><label for="invocieduedate"
                                                                             class="caption">{{trans('purchaseorders.invoiceduedate')}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="icon-calendar-o"
                                                                                             aria-hidden="true"></span>
                                                        </div>

                                                        {{ Form::text('invoiceduedate', null, ['class' => 'form-control round required', 'placeholder' => trans('invoices.invoicedate'),'data-toggle'=>'datepicker','autocomplete'=>'false']) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="taxFormat"
                                                           class="caption">{{trans('general.tax')}}</label>
                                                    <select class="form-control round"
                                                            onchange="changeTaxFormat(this)"
                                                            id="taxFormat">
                                                        @php
                                                            $tax_format='exclusive';
                                                            $tax_format_id=0;
                                                            $tax_format_type='exclusive';
                                                        @endphp
                                                        @foreach($additionals as $additional_tax)

                                                            @php
                                                                if($additional_tax->id == @$defaults[4][0]['feature_value']  && $additional_tax->class == 1){
                                                                 echo '<option value="'.numberFormat($additional_tax->value).'" data-type1="'.$additional_tax->type1.'" data-type2="'.$additional_tax->type2.'" data-type3="'.$additional_tax->type3.'" data-type4="'.$additional_tax->id.'" selected>--'.$additional_tax->name.'--</option>';
                                                                 $tax_format=$additional_tax->type2;
                                                                 $tax_format_id=$additional_tax->id;
                                                                 $tax_format_type=$additional_tax->type3;
                                                                }

                                                            @endphp
                                                            {!! $additional_tax->class == 1 ? "<option value='".numberFormat($additional_tax->value)."' data-type1='$additional_tax->type1' data-type2='$additional_tax->type2' data-type3='$additional_tax->type3' data-type4='$additional_tax->id'>$additional_tax->name</option>" : "" !!}--}}
                                                            <option value="{{$additional_tax->id}}">{{$additional_tax->Desc_ar}}</option>
                                                         @endforeach
                                                    </select>
                                                    <div class="col-sm-12">

                                                        <div class="form-group">
                                                            <label for="subTax"
                                                                class="caption">{{trans('general.sub_tax')}}</label>
                                                            <select class="form-control round" name="sub_tax_id"
                                                                    id="subTax">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label for="discountFormat"
                                                               class="caption">{{trans('general.discount')}}</label>
                                                        <select class="form-control round"
                                                                onchange="changeDiscountFormat()"
                                                                id="discountFormat">
                                                            @php
                                                                $discount_format='%';
                                                            @endphp
                                                            @foreach($additionals as $additional_discount)
                                                                @php
                                                                    if(@$defaults[3][0]['feature_value'] == $additional_discount->id && $additional_discount->class == 2){
                                                                     echo '<option value="'.$additional_discount->value.'" data-type1="'.$additional_discount->type1.'" data-type2="'.$additional_discount->type2.'" data-type3="'.$additional_discount->type3.'" selected>--'.$additional_discount->name.'--</option>';
                                                                     $discount_format=$additional_discount->type1;
                                                                    }

                                                                @endphp
                                                                {!! $additional_discount->class == 2 ? "<option value='$additional_discount->value' data-type1='$additional_discount->type1' data-type2='$additional_discount->type2' data-type3='$additional_discount->type3'>$additional_discount->name</option>" : "" !!}
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label for="toAddInfo"
                                                           class="caption">{{trans('general.note')}}</label>

                                                    {{ Form::textarea('notes', null, ['class' => 'form-control round', 'placeholder' => trans('general.note'),'rows'=>'2']) }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div id="saman-row">
                                    <table class="table-responsive tfr my_stripe">

                                        <thead>
                                        <tr class="item_header bg-gradient-directional-blue white">
                                            <th width="30%" class="text-center">{{trans('general.item_name')}}</th>
                                            <th width="8%" class="text-center">{{trans('general.quantity')}}</th>
                                            <th width="10%" class="text-center">{{trans('general.rate')}}</th>
                                            <th width="10%" class="text-center">{{trans('general.tax_p')}}</th>
                                            <th width="10%" class="text-center">{{trans('general.tax')}}</th>
                                            <th width="7%" class="text-center">{{trans('general.discount')}}</th>
                                            <th width="10%" class="text-center">{{trans('general.amount')}}
                                                ({{config('currency.symbol')}})
                                            </th>
                                            <th width="5%" class="text-center">{{trans('general.action')}}</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" name="product_name[]"
                                                       placeholder="{{trans('general.enter_product')}}"
                                                       id='productname-0'>
                                            </td>
                                            <td><input type="text" class="form-control req amnt" name="product_qty[]"
                                                       id="amount-0"
                                                       onkeypress="return isNumber(event)"
                                                       onkeyup="rowTotal('0'), billUpyog()"
                                                       autocomplete="off" value="1"><input type="hidden" id="alert-0"
                                                                                           value=""
                                                                                           name="alert[]"></td>
                                            <td><input type="text" class="form-control req prc" name="product_price[]"
                                                       id="price-0"
                                                       onkeypress="return isNumber(event)"
                                                       onkeyup="rowTotal('0'), billUpyog()"
                                                       autocomplete="off"></td>
                                            <td><input type="text" class="form-control vat " name="product_tax[]"
                                                       id="vat-0"
                                                       onkeypress="return isNumber(event)"
                                                       onkeyup="rowTotal('0'), billUpyog()"
                                                       autocomplete="off"></td>
                                            <td class="text-center" id="texttaxa-0">0</td>
                                            <td><input type="text" class="form-control discount"
                                                       name="product_discount[]"
                                                       onkeypress="return isNumber(event)" id="discount-0"
                                                       onkeyup="rowTotal('0'), billUpyog()" autocomplete="off"></td>
                                            <td><span class="currenty">{{config('currency.symbol')}}</span>
                                                <strong><span class='ttlText' id="result-0">0</span></strong></td>
                                            <td class="text-center">

                                            </td>
                                            <input type="hidden" name="total_tax[]" id="taxa-0" value="0">
                                            <input type="hidden" name="total_discount[]" id="disca-0" value="0">
                                            <input type="hidden" class="ttInput" name="product_subtotal[]" id="total-0"
                                                   value="0">
                                            <input type="hidden" class="pdIn" name="product_id[]" id="pid-0" value="0">
                                            <input type="hidden" name="unit[]" id="unit-0" value="">
                                            <input type="hidden" name="code[]" id="hsn-0" value="">
                                        </tr>
                                        <tr>
                                            <td colspan="6"><textarea id="dpid-0" class="form-control html_editor"
                                                                      name="product_description[]"
                                                                      placeholder="{{trans('general.enter_description')}} (Optional)"
                                                                      autocomplete="off"></textarea><br></td>
                                            <td colspan="2"><select class="form-control unit" data-uid="0" name="u_m[]"
                                                                    style="display: none">

                                                </select></td>
                                        </tr>

                                        <tr class="last-item-row sub_c">
                                            <td class="add-row">
                                                <button type="button" class="btn btn-success" aria-label="Left Align"
                                                        id="addproduct_purchaseorders">
                                                    <i class="fa fa-plus-square"></i> {{trans('general.add_row')}}
                                                </button>
                                            </td>
                                            <td colspan="7"></td>
                                        </tr>

                                        <tr class="sub_c" style="display: table-row;">
                                            <td colspan="6"
                                                align="right">{{ Form::hidden('subtotal','0',['id'=>'subttlform']) }}
                                                <strong>{{trans('general.total_tax')}}</strong>
                                            </td>
                                            <td align="left" colspan="2"><span
                                                        class="currenty lightMode">{{config('currency.symbol')}}</span>
                                                <span id="taxr" class="lightMode">0</span></td>
                                        </tr>
                                        <tr class="sub_c" style="display: table-row;">
                                            <td colspan="6" align="right">
                                                <strong>{{trans('general.total_discount')}}</strong></td>
                                            <td align="left" colspan="2"><span
                                                        class="currenty lightMode"></span>
                                                <span id="discs" class="lightMode">0</span></td>
                                        </tr>

                                        <tr class="sub_c" style="display: table-row;">
                                            <td colspan="6" align="right">
                                                <strong>{{trans('general.shipping')}}</strong></td>
                                            <td align="left" colspan="2"><input type="text" class="form-control shipVal"
                                                                                onkeypress="return isNumber(event)"
                                                                                placeholder="Value"
                                                                                name="shipping" autocomplete="off"
                                                                                onkeyup="billUpyog()">
                                                ( {{trans('general.tax')}} {{config('currency.symbol')}}
                                                <span id="ship_final">0</span> )
                                            </td>
                                        </tr>
                                        <tr class="sub_c" style="display: table-row;">
                                            <td colspan="6" align="right">
                                                <strong> {{trans('general.extra_discount')}}</strong>
                                            </td>
                                            <td align="left" colspan="2"><input type="text"
                                                                                class="form-control form-control-sm discVal"
                                                                                onkeypress="return isNumber(event)"
                                                                                placeholder="Value"
                                                                                name="discount_rate" autocomplete="off"
                                                                                value="0"
                                                                                onkeyup="billUpyog()">
                                                <input type="hidden"
                                                       name="after_disc" id="after_disc" value="0">
                                                ( {{config('currency.symbol')}}
                                                <span id="disc_final">0</span> )
                                            </td>
                                        </tr>


                                        <tr class="sub_c" style="display: table-row;">
                                            <td colspan="2">{{trans('general.payment_currency_client')}}
                                                <small>{{trans('general.based_live_market')}}</small>
                                                <select name="currency"
                                                        class="selectpicker form-control">
                                                    <option value="0">Default</option>
                                                    @foreach($currencies as $currency)
                                                        <option value="{{$currency->id}}">{{$currency->symbol}}
                                                            - {{$currency->code}}</option>
                                                    @endforeach

                                                </select></td>
                                            <td colspan="4" align="right"><strong>{{trans('general.grand_total')}}
                                                    (<span
                                                            class="currenty lightMode">{{config('currency.symbol')}}</span>)</strong>
                                            </td>
                                            <td align="left" colspan="2"><input type="text" name="total"
                                                                                class="form-control"
                                                                                id="invoiceyoghtml" readonly="">

                                            </td>
                                        </tr>
                                        <tr class="sub_c" style="display: table-row;">
                                            <td colspan="2">{{trans('general.payment_terms')}} <select name="term_id"
                                                                                                       class="selectpicker form-control">
                                                    @foreach($terms as $term)
                                                        <option value="{{$term->id}}">{{$term->title}}</option>
                                                    @endforeach

                                                </select></td>
                                            <td align="right" colspan="6"><input type="submit"
                                                                                 class="btn btn-success sub-btn btn-lg"
                                                                                 value="{{trans('general.generate')}}"
                                                                                 id="submit-data"
                                                                                 data-loading-text="Creating...">

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row mt-3">
                                        <div class="col-12">{!! $fields !!}</div>
                                    </div>
                                </div>

                                <input type="hidden" value="new_i" id="inv_page">
                                <input type="hidden" value="{{route('biller.purchaseorders.store')}}" id="action-url">
                                <input type="hidden" value="search" id="billtype">
                                <input type="hidden" value="0" name="counter" id="ganak">
                                <input type="hidden" value="{{$tax_format}}" name="tax_format_static" id="tax_format">
                                <input type="hidden" value="{{$tax_format_type}}" name="tax_format"
                                       id="tax_format_type">
                                <input type="hidden" value="{{$tax_format_id}}" name="tax_id" id="tax_format_id">
                                <input type="hidden" value="{{$discount_format}}"
                                       name="discount_format" id="discount_format">

                                @if(@$defaults[4][0]->ship_tax['id']>0) <input type='hidden'
                                                                               value='{{numberFormat($defaults[4][0]->ship_tax['value'])}}'
                                                                               name='ship_rate' id='ship_rate'><input
                                        type='hidden' value='{{$defaults[4][0]->ship_tax['type2']}}'
                                        name='ship_tax_type'
                                        id='ship_taxtype'>
                                @else
                                    <input type='hidden'
                                           value='{{numberFormat(0)}}'
                                           name='ship_rate' id='ship_rate'><input
                                            type='hidden' value='none' name='ship_tax_type'
                                            id='ship_taxtype'>
                                @endif


                                <input type="hidden" value="0" name="ship_tax" id="ship_tax">
                                <input type="hidden" value="0" id="custom_discount">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    @include("focus.modal.supplier")
@endsection
@section('extra-scripts')
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                format: '{{config('core.user_date_format')}}'
            });
            $('[data-toggle="datepicker"]').datepicker('setDate', '{{date(config('core.user_date_format'))}}');
            editor();
        });

        $('#productname-0').autocomplete({
            source: function (request, response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: baseurl + 'products/search/' + billtype,
                    dataType: "json",
                    method: 'post',
                    data: 'keyword=' + request.term + '&type=product_list&row_num=1&wid=' + $("#s_warehouses option:selected").val() + '&serial_mode=' + $("#serial_mode:checked").val(),
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.name,
                                value: item.name,
                                data: item
                            };
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 0,
            select: function (event, ui) {
                var t_r = ui.item.data.taxrate;
                var custom = accounting.unformat($("#taxFormat option:selected").val(), accounting.settings.number.decimal);
                if (custom > 0) {
                    t_r = custom;
                }
                var discount = ui.item.data.disrate;
                var custom_discount = $('#custom_discount').val();
                if (custom_discount > 0) discount = deciFormat(custom_discount);
                $('#amount-0').val(1);
                $('#price-0').val(accounting.formatNumber(ui.item.data.purchase_price));
                $('#pid-0').val(ui.item.data.id);
                $('#vat-0').val(accounting.formatNumber(t_r));
                $('#discount-0').val(accounting.formatNumber(discount));
                //$('#dpid-0').val(ui.item.data.product_des);
                $('#unit-0').val(ui.item.data.unit).attr('attr-org', ui.item.data.unit);
                $('#hsn-0').val(ui.item.data.code);
                $('#alert-0').val(ui.item.data.alert);
                $('#serial-0').val(ui.item.data.serial);
                $('.unit').show();
                unit_load();
                rowTotal(0);
                billUpyog();
                $('#dpid-0').summernote('code',ui.item.data.product_des);
            }
        });

        var rowTotal = function (numb) {
            //most res
            var result;
            var page = '';
            var totalValue = 0;
            var amountVal = accounting.unformat($("#amount-" + numb).val(), accounting.settings.number.decimal);
            var priceVal = accounting.unformat($("#price-" + numb).val(), accounting.settings.number.decimal);
            var discountVal = accounting.unformat($("#discount-" + numb).val(), accounting.settings.number.decimal);
            var vatVal = accounting.unformat($("#vat-" + numb).val(), accounting.settings.number.decimal);
            var taxo = 0;
            var disco = 0;
            var totalPrice = amountVal.toFixed(two_fixed) * priceVal;
            var tax_status = $("#taxFormat option:selected").attr('data-type2');
            var disFormat = $("#discount_format").val();
            if ($("#inv_page").val() == 'new_i' && formInputGet("#pid", numb) > 0) {
                var alertVal = accounting.unformat($("#alert-" + numb).val(), accounting.settings.number.decimal);
                if (alertVal <= +amountVal) {
                    var aqt = alertVal - amountVal;
                }
            }
            //tax after bill

            if (tax_status == 'exclusive') {
                if (disFormat == '%' || disFormat == 'flat') {
                    //tax

                    var Inpercentage = precentCalc(totalPrice, vatVal);
                    totalValue = totalPrice + Inpercentage;
                    taxo = accounting.formatNumber(Inpercentage);
                    if (disFormat == 'flat') {
                        disco = accounting.formatNumber(discountVal);
                        totalValue = totalValue - discountVal;
                    } else if (disFormat == '%') {
                        var discount = precentCalc(totalValue, discountVal);
                        totalValue = totalValue - discount;
                        disco = accounting.formatNumber(discount);
                    }

                } else {
                    //before tax
                    if (disFormat == 'b_flat') {
                        disco = accounting.formatNumber(discountVal);
                        totalValue = totalPrice - discountVal;
                    } else if (disFormat == 'b_per') {
                        var discount = precentCalc(totalPrice, discountVal);
                        totalValue = totalPrice - discount;
                        disco = accounting.formatNumber(discount);
                    }

                    //tax
                    var Inpercentage = precentCalc(totalValue, vatVal);
                    totalValue = totalValue + Inpercentage;
                    taxo = accounting.formatNumber(Inpercentage);
                }

            } else if (tax_status == 'inclusive') {
                if (disFormat == '%' || disFormat == 'flat') {
                    //tax
                    var Inpercentage = (totalPrice * vatVal) / (100 + vatVal);
                    totalValue = totalPrice;
                    taxo = accounting.formatNumber(Inpercentage);
                    if (disFormat == 'flat') {
                        disco = accounting.formatNumber(discountVal);
                        totalValue = totalValue - discountVal;
                    } else if (disFormat == '%') {
                        var discount = precentCalc(totalValue, discountVal);
                        totalValue = totalValue - discount;
                        disco = accounting.formatNumber(discount);
                    }
                } else {
                    //before tax
                    if (disFormat == 'b_flat') {
                        disco = accounting.formatNumber(discountVal);
                        totalValue = totalPrice - discountVal;
                    } else if (disFormat == 'b_per') {
                        var discount = precentCalc(totalPrice, discountVal);
                        totalValue = totalPrice - discount;
                        disco = accounting.formatNumber(discount);
                    }
                    //tax
                    var Inpercentage = (totalPrice * vatVal) / (100 + vatVal);
                    totalValue = totalValue;
                    taxo = accounting.formatNumber(Inpercentage);
                }
            } else {
                taxo = 0;
                if (disFormat == '%' || disFormat == 'flat') {
                    if (disFormat == 'flat') {
                        disco = accounting.formatNumber(discountVal);
                        totalValue = totalPrice - discountVal;
                    } else if (disFormat == '%') {
                        var discount = precentCalc(totalPrice, discountVal);
                        totalValue = totalPrice - discount;
                        disco = accounting.formatNumber(discount);
                    }

                } else {
                    //before tax
                    if (disFormat == 'b_flat') {
                        disco = accounting.formatNumber(discountVal);
                        totalValue = totalPrice - discountVal;
                    } else if (disFormat == 'b_per') {
                        var discount = precentCalc(totalPrice, discountVal);
                        totalValue = totalPrice - discount;
                        disco = accounting.formatNumber(discount);
                    }
                }
            }

            $("#result-" + numb).html(accounting.formatNumber(totalValue));
            $("#taxa-" + numb).val(taxo);
            $("#texttaxa-" + numb).text(taxo);
            $("#disca-" + numb).val(disco);
            $("#total-" + numb).val(accounting.formatNumber(totalValue));
            samanYog();
        };

        var billtype = $('#billtype').val();
        $('#addproduct_purchaseorders').on('click', function () {
            var cvalue = parseInt($('#ganak').val()) + 1;
            var nxt = parseInt(cvalue);
            $('#ganak').val(nxt);
            var functionNum = "'" + cvalue + "'";
            count = $('#saman-row div').length;
            //product row
            var data = '<tr><td><input type="text" class="form-control" name="product_name[]" placeholder="{{trans('general.enter_product')}}" id="productname-' + cvalue + '"></td><td><input type="text" class="form-control req amnt" name="product_qty[]" id="amount-' + cvalue + '" onkeypress="return isNumber(event)" onkeyup="rowTotal(' + functionNum + '), billUpyog()" autocomplete="off" value="1" ><input type="hidden" id="alert-' + cvalue + '" value=""  name="alert[]"> </td> <td><input type="text" class="form-control req prc" name="product_price[]" id="price-' + cvalue + '" onkeypress="return isNumber(event)" onkeyup="rowTotal(' + functionNum + '), billUpyog()" autocomplete="off"></td><td> <input type="text" class="form-control vat" name="product_tax[]" id="vat-' + cvalue + '" onkeypress="return isNumber(event)" onkeyup="rowTotal(' + functionNum + '), billUpyog()" autocomplete="off"></td> <td id="texttaxa-' + cvalue + '" class="text-center">0</td> <td><input type="text" class="form-control discount" name="product_discount[]" onkeypress="return isNumber(event)" id="discount-' + cvalue + '" onkeyup="rowTotal(' + functionNum + '), billUpyog()" autocomplete="off"></td> <td><span class="currenty">' + currency + '</span> <strong><span class=\'ttlText\' id="result-' + cvalue + '">0</span></strong></td> <td class="text-center"><button type="button" data-rowid="' + cvalue + '" class="btn btn-danger removeProd" title="Remove" > <i class="fa fa-minus-square"></i> </button> </td><input type="hidden" name="total_tax[]" id="taxa-' + cvalue + '" value="0"><input type="hidden" name="total_discount[]" id="disca-' + cvalue + '" value="0"><input type="hidden" class="ttInput" name="product_subtotal[]" id="total-' + cvalue + '" value="0"> <input type="hidden" class="pdIn" name="product_id[]" id="pid-' + cvalue + '" value="0"> <input type="hidden" name="unit[]" id="unit-' + cvalue + '" attr-org="" value=""> <input type="hidden" name="hsn[]" id="hsn-' + cvalue + '" value=""><input type="hidden" name="unit_m[]" id="unit_m-' + cvalue + '" value="1"> <input type="hidden" name="serial[]" id="serial-' + cvalue + '" value=""></tr><tr><td colspan="6"><textarea class="form-control html_editor"  id="dpid-' + cvalue + '" name="product_description[]" placeholder="Enter Product description" autocomplete="off"></textarea><br></td> <td colspan="2"><select class="form-control unit" data-uid="' + cvalue + '" name="u_m[]" style="display: none"></select></td></tr>';
            //ajax request
            // $('#saman-row').append(data);
            $('tr.last-item-row').before(data);
            editor();
            row = cvalue;

            $('#productname-' + cvalue).autocomplete({
                source: function (request, response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: baseurl + 'products/search/' + billtype,
                        dataType: "json",
                        method: 'post',
                        data: 'keyword=' + request.term + '&type=product_list&row_num=' + row + '&wid=' + $("#s_warehouses option:selected").val() + '&serial_mode=' + $("#serial_mode:checked").val(),
                        success: function (data) {
                            console.log(data)
                            response($.map(data, function (item) {
                                return {
                                    label: item.name,
                                    value: item.name,
                                    data: item
                                };
                            }));
                        }
                    });
                },
                autoFocus: true,
                minLength: 0,
                select: function (event, ui) {
                    id_arr = $(this).attr('id');
                    id = id_arr.split("-");
                    var t_r = ui.item.data.taxrate;
                    var custom = accounting.unformat($("#taxFormat option:selected").val(), accounting.settings.number.decimal);
                    if (custom > 0) {
                        t_r = custom;
                    }
                    var discount = ui.item.data.disrate;
                    var dup;
                    var custom_discount = $('#custom_discount').val();
                    if (custom_discount > 0) discount = deciFormat(custom_discount);
                    $('.pdIn').each(function () {
                        if ($(this).val() == ui.item.data.id) dup = true;
                    });
                    if (dup) {
                        alert('Already Exists!!');
                        return;
                    }
                    $('#amount-' + id[1]).val(1);
                    $('#price-' + id[1]).val(accounting.formatNumber(ui.item.data.purchase_price));
                    $('#pid-' + id[1]).val(ui.item.data.id);
                    $('#vat-' + id[1]).val(accounting.formatNumber(t_r));
                    $('#discount-' + id[1]).val(accounting.formatNumber(discount));
                    //  $('#dpid-' + id[1]).val(ui.item.data.product_des);
                    $('#unit-' + id[1]).val(ui.item.data.unit).attr('attr-org', ui.item.data.unit);
                    $('#hsn-' + id[1]).val(ui.item.data.code);
                    $('#alert-' + id[1]).val(ui.item.data.alert);
                    $('#serial-' + id[1]).val(ui.item.data.serial);
                    $('#dpid-' + id[1]).summernote('code',ui.item.data.product_des);

                    rowTotal(cvalue);
                    billUpyog();
                    if (typeof unit_load === "function") {
                        unit_load();
                        $('.unit').show();
                    }
                },
                create: function (e) {
                    $(this).prev('.ui-helper-hidden-accessible').remove();
                }
            });

        });

    </script>

<script type="text/javascript">
        $(function () {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                format: '{{config('core.user_date_format')}}'
            });
            $('[data-toggle="datepicker"]').datepicker('setDate', '{{date(config('core.user_date_format'))}}');
            editor();
        });
        function changeTaxFormat(data) {
            var el=$('#subTax');
            el.empty();
            var tax_id = data.value;
            var route = '{!! route('biller.invoice.allSubTaxes') !!}';
            jQuery.ajax({
                type: 'GET',
                url: route,
                data: {
                    tax_id: tax_id
                },
                success: function (data) {
                    $.each(data, function (index, obj) {
                        el.append('<option value="' + index + '">' + obj + '</option>');
                    });
                }
            });
        }

    </script>
@endsection
