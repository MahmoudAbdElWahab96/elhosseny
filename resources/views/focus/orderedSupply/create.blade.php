@extends ('core.layouts.app')

@section ('title', trans('labels.backend.orderedSupply.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.orderedSupply.management') }}
        <small>{{ trans('labels.backend.orderedSupply.create') }}</small>
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
                                                    <h3 class="title">{{trans('orderedSupply.bill_to')}} <a href='#'
                                                                                                       class="btn btn-primary btn-sm round"
                                                                                                       data-toggle="modal"
                                                                                                       data-target="#addCustomer">
                                                            {{trans('orderedSupply.add_client')}}
                                                        </a>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="frmSearch col-sm-12">
                                                    {{ Form::label( 'cst', trans('orderedSupply.search_client'),['class' => 'caption']) }}
                                                    {{ Form::text('cst', null, ['class' => 'form-control round', 'placeholder' =>trans('orderedSupply.enter_customer'), 'id'=>'customer-box','autocomplete'=>'off']) }}
                                                    <div id="customer-box-result"></div>
                                                </div>
                                            </div>
                                            <div id="customer">
                                                <div class="clientinfo">{{trans('orderedSupply.client_details')}}
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
                                            </div>


                                            {{ Form::hidden('customer_id', '0',['id'=>'customer_id']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 cmp-pnl">
                                        <div class="inner-cmp-pnl">


                                            <div class="form-group row">

                                                <div class="col-sm-12"><h3
                                                            class="title">{{trans('orderedSupply.orderedSupply_properties')}}</h3>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6"><label for="invocieno"
                                                                             class="caption">{{trans('orderedSupply.tid')}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="icon-file-text-o"
                                                                                             aria-hidden="true"></span>
                                                        </div>
                                                        {{ Form::number('tid', @$last_orderedSupply->tid+1, ['class' => 'form-control round', 'placeholder' => trans('orderedSupply.tid')]) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                @if($sub)
                                                    <div class="col-sm-6"><label for="invocieduedate"
                                                                                 class="caption">{{trans('orderedSupply.next_payment_after')}}</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon"><span class="icon-calendar-o"
                                                                                                 aria-hidden="true"></span>
                                                            </div>

                                                            <select name="recur_after"
                                                                    class="selectpicker form-control">
                                                                <option value="7 day">
                                                                    7 {{trans('general.days')}}</option>
                                                                <option value="14 day">
                                                                    14 {{trans('general.days')}}</option>
                                                                <option value="28 day">
                                                                    28 {{trans('general.days')}}</option>
                                                                <option value="30 day">
                                                                    30 {{trans('general.days')}}</option>
                                                                <option value="45 day">
                                                                    45 {{trans('general.days')}}</option>
                                                                <option value="2 month">
                                                                    2 {{trans('general.months')}}</option>
                                                                <option value="3 month">
                                                                    3 {{trans('general.months')}}</option>
                                                                <option value="6 month">
                                                                    6 {{trans('general.months')}}</option>
                                                                <option value="9 month">
                                                                    9 {{trans('general.months')}}</option>
                                                                <option value="1 year">
                                                                    1 {{trans('general.year')}}</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-sm-6"><label for="invocieduedate"
                                                                                 class="caption">{{trans('orderedSupply.orderedSupply_due_date')}}</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon"><span class="icon-calendar-o"
                                                                                                 aria-hidden="true"></span>
                                                            </div>

                                                            {{ Form::text('orderedSupplyduedate', null, ['class' => 'form-control round required', 'placeholder' => trans('orderedSupply.orderedSupplydate'),'data-toggle'=>'datepicker','autocomplete'=>'false']) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-6">
                                                    <label for="toAddInfo"
                                                           class="caption">{{trans('orderedSupply.orderedSupply_note')}}</label>

                                                    {{ Form::textarea('notes', null, ['class' => 'form-control round', 'placeholder' => trans('orderedSupply.orderedSupply_note'),'rows'=>'2']) }}
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
                                            <input type="hidden" attr-org="" name="unit[]" id="unit-0" value="">
                                            <input type="hidden" name="unit_m[]" id="unit_m-0" value="1">
                                            <input type="hidden" name="code[]" id="hsn-0" value="">
                                            <input type="hidden" name="serial[]" id="serial-0" value="">
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
                                                <button type="button" class="btn btn-success"
                                                        id="addproduct">
                                                    <i class="fa fa-plus-square"></i> {{trans('general.add_row')}}
                                                </button>
                                                <label for="serial_mode" class="form-check-label"><input type="checkbox"
                                                                                                         value="1"
                                                                                                         class="form-check-inline"
                                                                                                         name="serial_mode"
                                                                                                         id="serial_mode">
                                                    {{trans('products.search_serial_only')}}</label></td>
                                            <td colspan="6"></td>
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
                                                                                id="orderedSupplyyoghtml" readonly="">

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
                                <input type="hidden" name="sub" value="{{$sub}}">
                                <input type="hidden" name="p" value="{{$p}}">
                                <input type="hidden" value="{{route('biller.orderedSupply.store')}}" id="action-url">
                                <input type="hidden" value="search" id="billtype">
                                <input type="hidden" value="0" name="counter" id="ganak">

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
                                <input type="hidden" value="pos_orderedSupply/action" id="pos_action">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @include("focus.modal.customer")
@endsection
@section('extra-scripts')
    {{ Html::script('focus/js/select2.min.js') }}
    <script type="text/javascript">
        $(document).ready(function () {
            $("#taxFormat").select2();

            $("#taxFormat").on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element);

                $(this).trigger("change");
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
            var route = '{!! route('biller.orderedSupply.getSubTaxes') !!}';
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
