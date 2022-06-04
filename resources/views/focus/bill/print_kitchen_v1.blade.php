<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print {{$general['bill_type']}} {{$invoice['tid']}}</title>
    <style>
        body {
            color: #2B2000;
            font-family: 'Helvetica';
            font-size: 11pt;
        }

        @page {
            margin: 3mm;
        }

        .invoice-box {
            width: 210mm;
            padding: 0mm;
            border: 0;
            font-size: 11pt;
            line-height: 12pt;
            color: #000;
        }

        .party {
            border: #ccc 1px solid;
        }

        table tr.heading td {
            background: #515151;
            color: #FFF;
            padding: 6pt;
        }

        .company {
            width: 300pt;
        }

        .customer {
            width: 290pt;
        }

        .bill_info {
            font-size: 10pt;
        }

        .heading {
            width: 900pt;
        }

        .m_fill {
            background-color: #eee;
        }

        .product_list td {
            padding: 4px;
        }

        .product_row td {
            border: 1px solid #ddd;
        }

        .summary td {
            padding-left: 8pt;
            padding-right: 8pt;
            margin: 2px;
            border: 1px solid #ccc;


        }

        .sign {
            text-align: center;
            margin-bottom: 4pt
        }

        .logo_box {
            width: 60%;
            align: left;
        }

        .date_box {
            width: 30%;
            align: right;
        }

        .text_center {
            text-align: center;
        }

        .text_right {
            text-align: right;
        }

        .sign_box {
            display: block;
            margin-left: 400pt;
            width: 100pt;
            align: right;
        }

        .row {
            width: 100%;
        }


    </style>
</head>
<body dir="{{$general['direction']}}">
<div class="information">
    <table width="100%">
        <tr>
            <td class="logo_box">
                <img src="{{ Storage::disk('public')->url('app/public/img/company/' . $company['logo']) }}"
                     class="top_logo" height="120">
            </td>

            <td class="date_box">
                <table class="bill_info">
                    <tr>
                        <td colspan="1" class="text_right"><h4>{{$general['bill_type']}}</h4></td>
                    </tr>
                    <tr>
                        <td>{{$general['lang_bill_number']}}</td>
                        <td>: {{prefix($general['prefix'],$invoice['ins'])}} # {{$invoice['tid']}}</td>
                    </tr>
                    <tr>
                        <td>{{$general['lang_bill_date']}}</td>
                        <td>: {{dateFormat($invoice['invoicedate'],$company['main_date_format'])}}</td>
                    </tr>
                    <tr>
                        <td>{{$general['lang_bill_due_date']}}</td>
                        <td>: {{dateFormat($invoice['invoiceduedate'],$company['main_date_format'])}}</td>
                    </tr>
                    @if($invoice['refer'])
                        <tr>
                            <td>{{trans('general.reference')}}</td>
                            <td>: {{$invoice['refer']}}</td>
                        </tr>
                    @endif
                </table>


            </td>
        </tr>
    </table>
</div>
<br>
<div class="invoice-box">

    <table class="party" width="100%">
        <thead>
        <tr class="heading">
            <td>{{$general['person']}}:</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="customer">
               <strong> {{$invoice->customer->name}}</strong><br>   <strong> {{$invoice->customer->company}}</strong><br>
                {{$invoice->customer->address}}, {{$invoice->customer->city}}<br>
                {{$invoice->customer->region}}, {{$invoice->customer->country}} - {{$invoice->customer->postbox}}<br>
                {{trans('general.phone')}} : {{$invoice->customer->phone}}<br>
                {{trans('general.email')}} : {{$invoice->customer->email}}<br>
                @if($invoice->customer->taxid) {{$general['tax_id']}}: {{$invoice->customer->taxid}}<br>
                @endif
                {!! custom_fields_view($invoice['person'],$invoice['person_id'],2,$invoice['ins']) !!}
            </td>
        </tr>@if ($invoice->customer->name_s)
            <tr>
                <td><br><strong>{{trans('customers.address_s')}}</strong><br> {{$invoice->customer->name_s}}<br>
                    {{$invoice->customer->address_s}}, {{$invoice->customer->city_s}}<br>
                    {{$invoice->customer->region_s}}, {{$invoice->customer->country_s}}
                    - {{$invoice->customer->postbox_s}}<br>
                    {{trans('general.phone')}} : {{$invoice->customer->phone_s}}<br>
                    {{trans('general.email')}} : {{$invoice->customer->email_s}}</td>
            </tr>
        @endif
        </tbody>
    </table>
    <br>
    @php
        $fill = true;
    @endphp
    <table class="product_list" cellpadding="0" cellspacing="0" width="100%">

        {{--  exclusive --}}
        @if($invoice['tax_format']=='exclusive' OR $invoice['tax_format']=='inclusive'  OR $invoice['tax_format']=='off')
            <tr class="heading">
                <td style="width: 1rem;">
                    #
                </td>
                <td>
                    {{trans('products.product_des')}}
                </td>
                <td>
                    {{trans('products.qty')}}
                </td>
            </tr>

            @foreach($invoice->products as $product)
                @php
                    if ($fill == true) {
                      $flag = ' m_fill';
                  } else {
                      $flag = '';
                  }
                   $fill = !$fill;
                $col_span=4;
                @endphp
                <tr class="product_row {{$flag}}">
                    <td style="width: 1rem;">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{$product['product_name']}} @if(isset($product['serial'])){{$product['serial']}}@endif
                    </td>
                    <td>
                        {{numberFormat($product['product_qty'],$invoice['currency'])}} {{$product['unit']}}
                    </td>
                </tr>

            @endforeach
        @endif

        {{--  cgst --}}


    </table>
    <br>

  


</body>
</html>