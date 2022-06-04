@extends ('core.layouts.app')

@section ('title', trans('labels.backend.orderedSupply.management') . ' | ' . trans('labels.backend.orderedSupply.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.orderedSupply.management') }}
        <small>{{ trans('labels.backend.orderedSupply.edit') }}</small>
    </h1>
@endsection

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            {{ Form::model($orderedSupply, [ 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT', 'id' => 'data_form','files'=>true]) }}

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
                                                <div id="customer_name">{{$orderedSupply->customer->name}}</div>
                                            </div>
                                            <div class="clientinfo">
                                                <div id="customer_address1">{{$orderedSupply->customer->address}}
                                                    , {{$orderedSupply->customer->city}}</div>
                                            </div>
                                            <div class="clientinfo">
                                                <div id="customer_phone">{{$orderedSupply->customer->phone}}</div>
                                            </div>
                                            <hr>
                                            <div id="customer_pass"></div>
                                            <hr>
                                        </div>

                                        {{ Form::hidden('customer_id', $orderedSupply['customer_id'],['id'=>'customer_id']) }}
                                    </div>
                                </div>
                                <div class="col-sm-6 cmp-pnl">
                                    <div class="inner-cmp-pnl">

                                        <div class="form-group row">
                                            <div class="col-sm-6"><label for="invocieno"
                                                                         class="caption">{{trans('orderedSupply.tid')}}
                                                    #{{$sub['prefix']}}</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><span class="icon-file-text-o"
                                                                                         aria-hidden="true"></span>
                                                    </div>

                                                    {{ Form::number('tid',null, ['class' => 'form-control round', 'placeholder' => trans('orderedSupply.tid'),'readonly'=>'']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-6"><label for="invociedate"
                                                                         class="caption">{{trans('orderedSupply.orderedSupply_date')}}</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon"><span class="icon-calendar4"
                                                                                         aria-hidden="true"></span>
                                                    </div>
                                                    {{ Form::text('orderedSupplydate','', ['class' => 'form-control round required', 'placeholder' => trans('orderedSupply.orderedSupplydate'),'data-toggle'=>'datepicker','autocomplete'=>'false','id'=>'date1']) }}
                                                </div>
                                            </div>
                                            @if($orderedSupply->i_class>1)
                                                <div class="col-sm-6"><label for="invocieduedate"
                                                                             class="caption">{{trans('orderedSupply.next_payment_after')}}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="icon-calendar-o"
                                                                                             aria-hidden="true"></span>
                                                        </div>

                                                        <select name="recur_after" class="selectpicker form-control">
                                                            <option value="{{$orderedSupply->r_time}}">
                                                                --{{$orderedSupply->r_time}}(s)--
                                                            </option>
                                                            <option value="7 day">7 {{trans('general.days')}}</option>
                                                            <option value="14 day">14 {{trans('general.days')}}</option>
                                                            <option value="28 day">28 {{trans('general.days')}}</option>
                                                            <option value="30 day">30 {{trans('general.days')}}</option>
                                                            <option value="45 day">45 {{trans('general.days')}}</option>
                                                            <option value="2 month">
                                                                2 {{trans('general.months')}}</option>
                                                            <option value="3 month">
                                                                3 {{trans('general.months')}}</option>
                                                            <option value="6 month">
                                                                6 {{trans('general.months')}}</option>
                                                            <option value="9 month">
                                                                9 {{trans('general.months')}}</option>
                                                            <option value="1 year">1 {{trans('general.year')}}</option>


                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
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
                                    @php
                                        $total_tax=0;
                                        $counter=0;

                                    @endphp
                                    @foreach($orderedSupply->products as $product)

                                        @php
                                            $total_tax+=$product['total_tax'];
                                        @endphp
                                        <tr data-re="1">
                                            <td><input type="text" class="form-control" name="product_name[]"
                                                       placeholder="{{trans('general.enter_product')}}"
                                                       id='productname-{{$loop->index}}'
                                                       value="{{$product['product_name']}}">
                                            </td>
                                            <td><input type="text" class="form-control req amnt" name="product_qty[]"
                                                       id="amount-{{$loop->index}}"
                                                       onkeypress="return isNumber(event)"
                                                       onkeyup="rowTotal('{{$loop->index}}'), billUpyog()"
                                                       autocomplete="off"
                                                       value="{{numberFormat($product['product_qty'])}}"><input
                                                        type="hidden" id="alert-{{$loop->index}}"
                                                        value="{{@$product->variation['qty']}}"
                                                        name="alert[]"><input type="hidden"
                                                                              id="amount_old-{{$loop->index}}"
                                                                              value="{{numberFormat($product['product_qty'])}}"
                                                                              name="old_product_qty[]"></td>
                                            <td><input type="text" class="form-control req prc" name="product_price[]"
                                                       id="price-{{$loop->index}}"
                                                       onkeypress="return isNumber(event)"
                                                       onkeyup="rowTotal('{{$loop->index}}'), billUpyog()"
                                                       autocomplete="off"
                                                       value="{{numberFormat($product['product_price'])}}"></td>
                                            <td><input type="text" class="form-control vat " name="product_tax[]"
                                                       id="vat-{{$loop->index}}"
                                                       onkeypress="return isNumber(event)"
                                                       onkeyup="rowTotal('{{$loop->index}}'), billUpyog()"
                                                       autocomplete="off"
                                                       value="{{numberFormat($product['product_tax'])}}"></td>
                                            <td class="text-center"
                                                id="texttaxa-{{$loop->index}}">{{numberFormat($product['total_tax'])}}</td>
                                            <td><input type="text" class="form-control discount"
                                                       name="product_discount[]"
                                                       onkeypress="return isNumber(event)"
                                                       id="discount-{{$loop->index}}"
                                                       onkeyup="rowTotal('{{$loop->index}}'), billUpyog()"
                                                       autocomplete="off"
                                                       value="{{numberFormat($product['product_discount'])}}"></td>
                                            <td><span class="currenty">{{config('currency.symbol')}}</span>
                                                <strong><span class='ttlText'
                                                              id="result-{{$loop->index}}">{{numberFormat($product['product_subtotal'])}}</span></strong>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" data-rowid="{{$loop->index}}"
                                                        class="btn btn-danger removeProd" title="Remove"><i
                                                            class="fa fa-minus-square"></i></button>
                                            </td>
                                            <input type="hidden" name="total_tax[]" id="taxa-{{$loop->index}}"
                                                   value="{{numberFormat($product['total_tax'])}}">
                                            <input type="hidden" name="total_discount[]" id="disca-{{$loop->index}}"
                                                   value="{{numberFormat($product['total_discount'])}}">
                                            <input type="hidden" class="ttInput" name="product_subtotal[]"
                                                   id="total-{{$loop->index}}"
                                                   value="{{numberFormat($product['product_subtotal'])}}">
                                            <input type="hidden" class="pdIn" name="product_id[]"
                                                   id="pid-{{$loop->index}}" value="{{$product['product_id']}}">
                                            <input type="hidden" name="unit[]" id="unit-{{$loop->index}}"
                                                   value="{{$product['unit']}}">
                                            <input type="hidden" name="unit_m[]" id="unit_m-{{$loop->index}}"
                                                   value="{{$product['unit_value']}}">
                                            <input type="hidden" name="code[]" id="hsn-{{$loop->index}}"
                                                   value="{{$product['code']}}">
                                        </tr>

                                        <tr>
                                            <td colspan="8"><textarea id="dpid-{{$loop->index}}"
                                                                      class="form-control html_editor"
                                                                      name="product_description[]"
                                                                      placeholder="{{trans('general.enter_description')}} (Optional)"
                                                                      autocomplete="off">{{$product['product_des']}}</textarea><br>
                                            </td>
                                        </tr>
                                        @php
                                            $counter=$loop->index;
                                        @endphp
                                    @endforeach
                                    <tr class="last-item-row sub_c">
                                        <td class="add-row">
                                            <button type="button" class="btn btn-success" aria-label="Left Align"
                                                    id="addproduct">
                                                <i class="fa fa-plus-square"></i> {{trans('general.add_row')}}
                                            </button>
                                        </td>
                                        <td colspan="7"></td>
                                    </tr>

                                    <tr class="sub_c" style="display: table-row;">
                                        <td colspan="6"
                                            align="right">{{ Form::hidden('subtotal',null,['id'=>'subttlform']) }}
                                            <strong>{{trans('general.total_tax')}}</strong>
                                        </td>
                                        <td align="left" colspan="2"><span
                                                    class="currenty lightMode">{{config('currency.symbol')}}</span>
                                            <span id="taxr" class="lightMode">{{numberFormat($total_tax)}}</span></td>
                                    </tr>
                                    <tr class="sub_c" style="display: table-row;">
                                        <td colspan="6" align="right">
                                            <strong>{{trans('general.total_discount')}}</strong></td>
                                        <td align="left" colspan="2"><span
                                                    class="currenty lightMode"></span>
                                            <span id="discs"
                                                  class="lightMode">{{numberFormat($orderedSupply['discount']-$orderedSupply['extra_discount'])}}</span>
                                        </td>
                                    </tr>

                                    <tr class="sub_c" style="display: table-row;">
                                        <td colspan="6" align="right">
                                            <strong>{{trans('general.shipping')}}</strong></td>
                                        <td align="left" colspan="2"><input type="text" class="form-control shipVal"
                                                                            onkeypress="return isNumber(event)"
                                                                            placeholder="Value"
                                                                            name="shipping" autocomplete="off"
                                                                            onkeyup="billUpyog()"
                                                                            value="{{numberFormat($orderedSupply['shipping'])}}">
                                            ( {{trans('general.tax')}} {{config('currency.symbol')}}
                                            <span id="ship_final">{{numberFormat($orderedSupply['ship_tax'])}}</span> )
                                        </td>
                                    </tr>
                                    <tr class="sub_c" style="display: table-row;">
                                        <td colspan="2">{{trans('general.payment_currency_client')}}
                                            <small>{{trans('general.based_live_market')}}</small>
                                            <select name="currency"
                                                    class="selectpicker form-control">
                                                <option value="0">Default</option>
                                                @foreach($currencies as $currency)
                                                    <option value="{{$currency->id}}" {{$currency->id==$orderedSupply['currency'] ? 'selected' : ''}}>{{$currency->symbol}}
                                                        - {{$currency->code}}</option>
                                                @endforeach

                                            </select></td>
                                        <td colspan="4" align="right">
                                            <strong> {{trans('general.extra_discount')}}</strong>
                                        </td>
                                        <td align="left" colspan="2"><input type="text"
                                                                            class="form-control form-control-sm discVal"
                                                                            onkeypress="return isNumber(event)"
                                                                            placeholder="Value"
                                                                            name="discount_rate" autocomplete="off"
                                                                            value="{{numberFormat($orderedSupply['discount_rate'])}}"
                                                                            onkeyup="billUpyog()">
                                            <input type="hidden"
                                                   name="after_disc" id="after_disc"
                                                   value="{{numberFormat($orderedSupply['extra_discount'])}}">
                                            ( {{config('currency.symbol')}}
                                            <span id="disc_final">{{numberFormat($orderedSupply['extra_discount'])}}</span> )
                                        </td>
                                    </tr>


                                    <tr class="sub_c" style="display: table-row;">
                                        <td colspan="2">{{trans('general.payment_terms')}} <select name="term_id"
                                                                                                   class="selectpicker form-control">
                                                @foreach($terms as $term)
                                                    <option value="{{$term->id}}" {{$term->id==$orderedSupply['term_id'] ? 'selected' : ''}} >{{$term->title}}</option>
                                                @endforeach

                                            </select></td>
                                        <td colspan="4" align="right"><strong>{{trans('general.grand_total')}}
                                                (<span
                                                        class="currenty lightMode">{{config('currency.symbol')}}</span>)</strong>
                                        </td>
                                        <td align="left" colspan="2"><input type="text" name="total"
                                                                            class="form-control"
                                                                            value="{{numberFormat($orderedSupply['total'])}}"
                                                                            id="orderedSupplyyoghtml" readonly="">

                                        </td>
                                    </tr>
                                    <tr class="sub_c" style="display: table-row;">
                                        <td colspan="2">{{trans('sales_channel.sales_channel')}} <select name="sales_channel"
                                                                                                         class="selectpicker form-control">
                                                @if(!isset($current_salesChannel->c_id))     <option value="0" selected>---</option> @endif
                                                @foreach($salesChannels as $salesChannel)
                                                    <option value="{{$salesChannel->id}}" @if($salesChannel->id==@$current_salesChannel->c_id) selected @endif>{{$salesChannel->name}}</option>
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
                                    <div class="col-12">{!! $fields_data !!}</div>
                                </div>
                            </div>
                            <input type="hidden" value="new_i" id="inv_page">
                            <input type="hidden" value="{{route('biller.orderedSupply.update',$orderedSupply['id'])}}"
                                   id="action-url">
                            <input type="hidden" value="search" id="billtype">
                            <input type="hidden" value="{{$counter}}" name="counter" id="ganak">
                            <input type="hidden" value="{{$orderedSupply['tax_id']}}" name="tax_id" id="tax_format_id">
                            <input type='hidden' value='{{numberFormat($orderedSupply['ship_tax_rate'])}}'
                                   name='ship_rate' id='ship_rate'><input
                                    type='hidden' value='{{$orderedSupply['ship_tax_type']}}' name='ship_tax_type'
                                    id='ship_taxtype'>
                            <input type="hidden" value="0" id="custom_discount">
                            <input type="hidden" value="{{numberFormat($orderedSupply['ship_tax'])}}" name="ship_tax"
                                   id="ship_tax">
                            <input type="hidden" value="{{$orderedSupply['id']}}" name="id">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    @include("focus.modal.customer")
@section('extra-scripts')
    <script type="text/javascript">

        $(function () {
            $('[data-toggle="datepicker"]').datepicker({
                autoHide: true,
                format: '{{config('core.user_date_format')}}'
            });
            $('#date1').datepicker('setDate', '{{dateFormat($orderedSupply['orderedSupplydate'])}}');
            $('#date2').datepicker('setDate', '{{dateFormat($orderedSupply['orderedSupplyduedate'])}}');
            editor();
        });


    </script>
@endsection
@endsection
