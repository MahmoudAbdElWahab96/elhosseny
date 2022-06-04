<input type="hidden" name="screen_id" value="{{$screen['id']}}">
@if($screen['type'] == 1)
    <div class='form-group'>
        {{ Form::label( 'customer', trans('customers.customer'),['class' => 'col-12 control-label']) }}
        <div class="col">
            <select name="customer" class='col form-control round' id="customer">
                <option value="">{{trans('costcenters.select')}}</option>

                @foreach($customers as $key => $value)
                    <option value="{!! $key !!}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'code', trans('costcenters.code'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('code', $costcenter->code ?? '', ['class' => 'form-control round', 'placeholder' => trans('costcenters.code'),'required'=>'' , 'id' => 'code']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_en', trans('costcenters.name_en'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_en', $costcenter->name_en ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_en'),'required'=>'' , 'id' => 'name_en', 'readonly']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_ar', trans('costcenters.name_ar'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_ar', $costcenter->name_ar ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_ar'),'required'=>'' , 'id' => 'name_ar' , 'readonly']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'cost_balance', trans('costcenters.cost_balance'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('cost_balance', $costcenter->cost_balance ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.cost_balance'),'required'=>'' , 'id' => 'cost_balance']) }}
        </div>
    </div>

@elseif($screen['type'] == 2)
    <div class='form-group'>
        {{ Form::label( 'supplier', trans('suppliers.supplier'),['class' => 'col-12 control-label']) }}
        <div class="col">
            <select name="supplier" class='col form-control round' id="supplier">
                <option value="">{{trans('costcenters.select')}}</option>

                @foreach($suppliers as $key => $value)
                    <option value="{!! $key !!}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'code', trans('costcenters.code'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('code', $costcenter->code ?? '', ['class' => 'form-control round', 'placeholder' => trans('costcenters.code'),'required'=>'' , 'id' => 'code']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_en', trans('costcenters.name_en'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_en', $costcenter->name_en ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_en'),'required'=>'' , 'id' => 'name_en', 'readonly']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_ar', trans('costcenters.name_ar'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_ar', $costcenter->name_ar ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_ar'),'required'=>'' , 'id' => 'name_ar', 'readonly']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'cost_balance', trans('costcenters.cost_balance'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('cost_balance', $costcenter->cost_balance ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.cost_balance'),'required'=>'' , 'id' => 'cost_balance']) }}
        </div>
    </div>

@elseif($screen['type'] == 3)
    <div class='form-group'>
        {{ Form::label( 'employee', trans('hrms.employee'),['class' => 'col-12 control-label']) }}
        <div class="col">
            <select name="employee" class='col form-control round' id="employee">
                <option value="">{{trans('costcenters.select')}}</option>
                @foreach($employees as $key => $value)
                    <option value="{!! $key !!}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class='form-group'>
        {{ Form::label( 'code', trans('costcenters.code'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('code', $costcenter->code ?? '', ['class' => 'form-control round', 'placeholder' => trans('costcenters.code'),'required'=>'', 'id' => 'code']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_en', trans('costcenters.name_en'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_en', $costcenter->name_en ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_en'),'required'=>'' , 'id' => 'name_en', 'readonly']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_ar', trans('costcenters.name_ar'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_ar', $costcenter->name_ar ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_ar'),'required'=>'' , 'id' => 'name_ar', 'readonly']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'cost_balance', trans('costcenters.cost_balance'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('cost_balance', $costcenter->cost_balance ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.cost_balance'),'required'=>'' , 'id' => 'cost_balance']) }}
        </div>
    </div>
@else
    <div class='form-group'>
        {{ Form::label( 'code', trans('costcenters.code'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('code', $costcenter->code ?? '', ['class' => 'form-control round', 'placeholder' => trans('costcenters.code'),'required'=>'' , 'id' => 'code']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_en', trans('costcenters.name_en'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_en', $costcenter->name_en ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_en'),'required'=>'' , 'id' => 'name_en']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name_ar', trans('costcenters.name_ar'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('name_ar', $costcenter->name_ar ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.name_ar'),'required'=>'' , 'id' => 'name_ar']) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'cost_balance', trans('costcenters.cost_balance'),['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            {{ Form::text('cost_balance', $costcenter->cost_balance ?? null, ['class' => 'form-control round', 'placeholder' => trans('costcenters.cost_balance'),'required'=>'' , 'id' => 'cost_balance']) }}
        </div>
    </div>
@endif




<div class='form-group'>
    <input type="checkbox" class="" name="active" id="active"
           value="1" @if(isset($costcenter) && $costcenter['active'] == 0) @else checked @endif>
    <label class="" for="active">{{trans('costcenters.active')}}</label>
</div>


@section("after-scripts")
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $(document).ready(function () {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var dataTable = $('#costcenters-table').dataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                language: {
                    @lang('datatable.strings')
                },
                ajax: {
                    url: '{{ route("biller.costcenters.get" , [$screen['id']]) }}',
                    type: 'post'
                },
                columns: [
                    {data: 'DT_Row_Index', name: 'id'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'cost_balance', name: 'cost_balance'},
                    {data: 'code', name: 'code'},
                    // {data: 'type', name: 'type'},

                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'Blfrtip',
                buttons: {
                    buttons: [

                        {extend: 'csv', footer: true, exportOptions: {columns: [0, 1]}},
                        {extend: 'excel', footer: true, exportOptions: {columns: [0, 1]}},
                        {extend: 'print', footer: true, exportOptions: {columns: [0, 1]}}
                    ]
                }
            });
            $('#costcenters-table_wrapper').removeClass('form-inline');

        });
        $("#employee").on("change", function (e) {
            var employee = $(this).val();
            $.ajax({
                type: "GET",
                url: '{{ route("biller.getEmployeeData") }}',
                data: {
                    employee: employee
                },
                success: function (data) {
                    $('#code').val(data['increment']);
                    $('#name_en').val(data['first_name'] + data['last_name']);
                    $('#name_ar').val(data['first_name'] + data['last_name']);
                }
            });
        });
        $("#customer").on("change", function (e) {
            var customer = $(this).val();
            $.ajax({
                type: "GET",
                url: '{{ route("biller.getCustomerData") }}',
                data: {
                    customer: customer
                },
                success: function (data) {
                    $('#name_en').val(data['name']);
                    $('#name_ar').val(data['name']);
                }
            });
        });
        $("#supplier").on("change", function (e) {
            var supplier = $(this).val();
            $.ajax({
                type: "GET",
                url: '{{ route("biller.getSupplierData") }}',
                data: {
                    supplier: supplier
                },
                success: function (data) {
                    $('#name_en').val(data['name']);
                    $('#name_ar').val(data['name']);
                }
            });
        });
    </script>

@endsection
