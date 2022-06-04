<div class='form-group'>
    {{ Form::label( 'tid', trans('orderedSupply.tid'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('tid', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.tid')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'orderedSupplydate', trans('orderedSupply.orderedSupplydate'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('orderedSupplydate', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.orderedSupplydate')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'orderedSupplyduedate', trans('orderedSupply.orderedSupplyduedate'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('orderedSupplyduedate', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.orderedSupplyduedate')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'subtotal', trans('orderedSupply.subtotal'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('subtotal', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.subtotal')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'shipping', trans('orderedSupply.shipping'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('shipping', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.shipping')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'ship_tax', trans('orderedSupply.ship_tax'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('ship_tax', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.ship_tax')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'ship_tax_type', trans('orderedSupply.ship_tax_type'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('ship_tax_type', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.ship_tax_type')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'discount', trans('orderedSupply.discount'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('discount', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.discount')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'discount_rate', trans('orderedSupply.discount_rate'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('discount_rate', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.discount_rate')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'tax', trans('orderedSupply.tax'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('tax', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.tax')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'total', trans('orderedSupply.total'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('total', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.total')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'pmethod', trans('orderedSupply.pmethod'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('pmethod', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.pmethod')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'notes', trans('orderedSupply.notes'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('notes', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.notes')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'status', trans('orderedSupply.status'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('status', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.status')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'csd', trans('orderedSupply.csd'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('csd', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.csd')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'eid', trans('orderedSupply.eid'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('eid', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.eid')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'pamnt', trans('orderedSupply.pamnt'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('pamnt', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.pamnt')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'items', trans('orderedSupply.items'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('items', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.items')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'taxstatus', trans('orderedSupply.taxstatus'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('taxstatus', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.taxstatus')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'discstatus', trans('orderedSupply.discstatus'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('discstatus', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.discstatus')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'format_discount', trans('orderedSupply.format_discount'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('format_discount', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.format_discount')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'refer', trans('orderedSupply.refer'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('refer', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.refer')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'term', trans('orderedSupply.term'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('term', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.term')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'multi', trans('orderedSupply.multi'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('multi', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.multi')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'i_class', trans('orderedSupply.i_class'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('i_class', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.i_class')]) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'r_time', trans('orderedSupply.r_time'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('r_time', null, ['class' => 'form-control box-size', 'placeholder' => trans('orderedSupply.r_time')]) }}
    </div>
</div>

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $(document).ready(function () {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
