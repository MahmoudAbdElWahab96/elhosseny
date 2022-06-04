<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print {{$title}}</title>

    <link rel="stylesheet" href="{{ asset('/pdf/pdf/bootstrap.min.css') }} ">

    <!-- Arabic Style -->
    <style>
        table * {
            text-align: right;
        }
        h1.h1111 small {display: inline-block;}
        body .dl-horizontal .dt {
            text-align: right !important;
        }

        .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            float: right;
        }
    </style>

    <style>
        img.media-object.logo {
    margin-top: 15px;
}
        .media {
    display: flex;
}
        @page {
            size: A4;
            margin: 0;
        }

.media-body, .media-left, .media-right {
    display: block;
    width: auto;
}

.invoice-header .media .media-body {
    width: auto;
}

table.main-table thead tr th span {
    width: 100px;
    display: block;
}
        .invoice-body {
            padding: 0 !important;
        }

        table.table.main-table.table-bordered {
            margin-bottom: 20px !important;
        }

        .invoice-header {
            padding: 0 !important;
        }

        html,
        body {
            direction: rtl !important;
            text-align: right !important;
        }

        .container.invoice {
            width: 100%;
            padding: 0;
        }

        .invoice-body {
            border-radius: 10px;
            padding: 25px;
            background: #FFF;
        }

        .invoice-header {
            padding: 0px 30px 0;
        }

        .invoice-header h1 {
            margin: 0;
        }

        .invoice-header .media .media-body {
            font-size: .9em;
            margin: 0;
        }

        .table-without-margin td {
            padding: 0 !important;
        }

        .table-without-margin th {
            padding: 0 !important;
        }

        .table-without-margin {
            margin-bottom: 5px !important;
            margin-top: 5px !important;
        }

        .invoice-footer {
            padding: 15px;
            font-size: 0.9em;
            text-align: center;
            color: #999;
        }

        .logo {
            max-height: 132px;
            border-radius: 0px;
        }

        .dl-horizontal {
            margin: 0;
        }

        .dd {
            margin-left: 90px;
        }

        .dt {
            float: left;
            overflow: hidden;
            clear: left;
            text-align: right;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .down-up {
            max-height: 30px;
            border-radius: 50%;
            /* border:1px solid; */
        }

        .div-left {
            margin-bottom: 20px !important;

        }

        .list-right {
            padding-top: 30px;
            line-height: 1.5;
        }

        .list-left {
            line-height: 1.5 !important;
        }

        .span-img {
            margin-right: 9px;
        }

        .h1111 {
            margin: 0;
            /* margin-top:-30px !important; */
            margin-bottom: 26px !important;
            font-weight: 700 !important;
            line-height: 1.7 !important;
        }

        .rowamount {
            padding-top: 15px !important;
        }
        .rowtotal {
            font-size: 1.3em;
        }
        .mono {
            font-family: monospace;
        }
        .dl-horizontal .dt {
            width: 100% !important;
            text-align: left !important;
            font-weight: 500 !important;

        }
        .table-borderless>tbody>tr>td,
        .table-borderless>tbody>tr>th,
        .table-borderless>tfoot>tr>td,
        .table-borderless>tfoot>tr>th,
        .table-borderless>thead>tr>td,
        .table-borderless>thead>tr>th {
            border: none;
        }

        tbody>tr>td {
            border: none;
        }

        .panel {
            height: 100% !important;
            max-height: 100% !important;
        }

        table.main-table thead tr th:nth-of-type(even) {
            background: #fff;
        }

        .main-table thead {
            border-bottom: 1px solid #ddd;
        }

        table.main-table thead tr th {
            vertical-align: middle;
        }

        .second-table {
            border: 1px solid #ddd;
        }
    </style>
    <title>no title</title>
</head>

<body dir="rtl">

    <div class="container invoice">
        <div class="invoice-header">
            <div class="row">

                <div class="col-xs-8 div-left">

                    <h1 class="h1111">
                        <span class="span-img"><img class=" down-up"
                                src="{{ asset('/pdf/pdf/buttn-arrow.jpg') }}" /></span>Invoice <small>v0.9</small>
                    </h1>
                    <ul class="media-body list-unstyled ">
                        <li><strong>الرقم الإلكتروني:</strong> OJQ9DYFZKEWT32F2DE3PC03F10</li>
                        <li><strong>الرقم الداخلي:</strong> 12001545455454</li>
                        <li><strong>تاريخ التقديم:</strong> 4/11/2021 1:57:16 PM (4/11/2021 11:57:16 AM UTC)</li>
                        <li><strong>تاريخ الإصدار:</strong> 4/11/2021 1:57:16 PM (4/11/2021 11:57:16 AM UTC)</li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <div class="media">

                        <ul class="media-body list-unstyled list-right">
                            <li><strong>حالة الفاتورة:</strong> صحيح</li>
                            <li><strong>رقم الهوية:</strong>12001545455454</li>
                            <li><strong>رقم التسجيل للبائع:</strong> 535904355</li>
                        </ul>
                        <div class="media-left">
                            <img class="media-object logo" src="{{ asset('/pdf/pdf/barcode.png') }}"  />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">البائع</h3>
                        </div>
                        <div class="panel-body">
                            <div class="dl dl-horizontal">
                                <div class="dt">الإسم</div>
                                <div class="dt">Mohamed elghoniemy</div>
                                <div class"dt">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>العنوان</th>
                                                <th>كود النشاط الضريبي</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>null,null,الحي التاسع عشر 4610</td>
                                                <td>4610</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">المشتري</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <div class="dt">الإسم</div>
                                <div class="dt">شركة الناسجون الشرقيون للسجاد</div>
                                <div class="dt">
                                    <table class="table table-borderless table-without-margin"
                                        style="margin-bottom: 0;">
                                        <thead>
                                            <th>رقم الهوية</th>
                                            <th>النوع</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1200154545454554</td>
                                                <td>أجنبي</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="dt">العنوان</div>
                                <div class="dt">null, null, 99 street NO. 1, null, null, المقطم القاهرةو US , null</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">البنود</h3>
                </div>
                <table class="table main-table table-bordered" style="margin:0;padding:0;">
                    <thead style="background-color: #f5f5f5;">
                        <tr>
                            <th>اسم الكود <span></span></th>
                            <th>مخطط نظام التكويد</th>
                            <th>كود الصنف / الكود الداخلي</th>
                            <th>الكمية / نوع الوحدة</th>
                            <th>سعر الوحدة</th>
                            <th>المبلغ الإجمالي للمبيعات</th>
                            <th>نسبة الخصم / قيمة الخصم</th>
                            <th>قيمة ضريبية</th>
                            <th>فرق لأغراض الضريبة</th>
                            <th>إجمالي الرسوم الخاضعة للضريبة</th>
                            <th>المجموع (ج.م) / خصم الأصناف</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $val)
                        <tr>
                            <td>
{{--                                <span>مخلفات متنوعة / وصف المنتج / اسم المنتج</span>--}}
                                <span>{{$val->product_name}}</span>
                            </td>
                            <td>
                                <span>EGS</span>
                            </td>
                            <td>
                                <span> EG-535354/ {{$val->code}}</span>
                            </td>
                            <td>
                                <span>10,00000/ EA</span>
                            </td>
                            <td>
                                <span>{{$val->product_price}}</span>

                            </td>
                            <td>
                                <span>10,00000</span>

                            </td>
                            <td>
                                <span>587.4725/ 0.0000 %</span>
                            </td>
                            <td>
                                <span>2,390800</span>
                            </td>
                            <td>
                                <span>0.00000</span>
                            </td>
                            <td>
                                <span>0.00000</span>
                            </td>
                            <td>
                                <span>11,76.944 / 37.65011 </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-2 col-md-2">&nbsp;</div>
                    <div class="col-xs-8 col-md-8">
                        <div class="panel-heading" style="background-color: #f5f5f5;">
                            <h3 class="panel-title"><strong>قيمة ضريبية: 2,390.4000</strong></h3>
                        </div>
                        <table class="table table-borderless second-table">
                            <thead>
                                <tr>
                                    <th>نوع الضريبة </th>
                                    <th>النوع الفرعي</th>
                                    <th>نسبة الضريبة</th>
                                    <th>القيمة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>ضريبة الجدول (نسبة)</span>
                                    </td>
                                    <td>
                                        <span>ضريبة الجدول (نسبة)</span>
                                    </td>
                                    <td>
                                        <span> 10.00 %</span>
                                    </td>
                                    </td>
                                    <td>
                                        <span>941.2576 </span>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>ضريبة القيمة المضافة</span>
                                    </td>
                                    <td>
                                        <span>سلع عامة</span>
                                    </td>
                                    <td>
                                        <span> 14.00 %</span>
                                    </td>
                                    </td>
                                    <td>
                                        <span>1,449,529 </span>

                                    </td>
                                </tr>


                            </tbody>

                        </table>

                    </div>
                    <div class="col-xs-12 col-md-2">&nbsp;</div>
                </div>
                <div style="border-top: 1px solid; ">
                    <div class="row">
                        <div class="col-xs-8 col-sm-8">
                            &nbsp;
                        </div>
                        <div class="col-xs-4 col-sm-4">
                            <table class="table table-bordered" style="margin:0;padding:0;">
                                <tr>
                                    <th>إجمالي المبيعات (EUR)</th>
                                    <td class="long">10,0000.000000</td>
                                </tr>
                                <tr>
                                    <th>إجمالي الخصم (EUR)</th>
                                    <td class="long">587.47445</td>
                                </tr>
                                <tr>
                                    <th>إجمالي خصم الأصناف (EUR)</th>
                                    <td class="long">37.65011</td>
                                </tr>
                                <tr>
                                    <th>ضريبة القيمة المضافة (EUR)</th>
                                    <td class="long">1,499.52924</td>
                                </tr>
                                <tr>
                                    <th>ضريبة الجدول (نسبة) (EUR)</th>
                                    <td class="long">941.25276</td>
                                </tr>
                                <tr>
                                    <th>خصم إضافي علي إجمالي الفاتورة (EUR)</th>
                                    <td class="long">1,307.29549</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>
</html>