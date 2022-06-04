@extends ('core.layouts.app')

@section ('title', trans('labels.backend.costcenters.management') . ' | ' . trans('labels.backend.costcenters.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.costcenters.management') }}
        <small>{{ trans('labels.backend.costcenters.create') }}</small>
    </h1>
@endsection

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h4 class="content-header-title mb-0">{{ trans('labels.backend.costcenters.create') }}</h4>

                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content">
                                <h1>
                                </h1>
                                <div class="card-body">
                                    <table id="costcenters-table"
                                           class="table table-striped table-bordered zero-configuration" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{!! trans('costcenters.code') !!} </th>
                                            <th>{!! trans('costcenters.name_ar') !!} </th>
                                            <th>{!! trans('costcenters.name_en') !!} </th>
                                            <th>{!! trans('costcenters.cost_balance') !!} </th>
                                            <th>{!! trans('costcenters.type') !!} </th>
                                            <th>{{ trans('labels.general.actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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
                    url: '{{ route("biller.allCostcenters.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'DT_Row_Index', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'name_ar', name: 'name_ar'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'cost_balance', name: 'cost_balance'},
                    {data: 'screen_type', name: 'screen_type'},
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
