@extends ('core.layouts.app')

@section ('title', trans('labels.backend.branches.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.branches.management') }}</h1>
@endsection

@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h4 class="content-header-title mb-0">{{ trans('labels.backend.branches.management') }}</h4>

                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">

                        <div class="media-body media-right text-right">
                            @include('focus.branches.partials.branches-header-buttons')
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content">

                                <div class="card-body">
                                    <table id="branches-table"
                                           class="table table-striped table-bordered zero-configuration" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('branches.name') }}</th>
                                            <th>{{ trans('hrms.country') }}</th>
                                            <th>{{ trans('branches.region') }}</th>
                                            <th>{{ trans('hrms.city') }}</th>
                                            <th>{{ trans('hrms.postal') }}</th>
                                            <th>{{ trans('hrms.phone') }}</th>
                                            <th>{{ trans('hrms.email') }}</th>
                                            <th>{{ trans('labels.general.actions') }}</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <tr>
                                            <td colspan="100%" class="text-center text-success font-large-1"><i
                                                        class="fa fa-spinner spinner"></i></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <small>* referred to  branch balance in single entry system.</small>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        $(function () {

            setTimeout(function () {
                draw_data()
            }, {{config('master.delay')}});
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            function draw_data() {

                var dataTable = $('#branches-table').dataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: '{{ route("biller.branches.get") }}',
                        type: 'post'
                    },
                    columns: [
                    {data: 'DT_Row_Index', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'country', name: 'country'},
                    {data: 'region', name: 'region'},
                    {data: 'city', name: 'city'},
                    {data: 'postbox', name: 'postbox'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    dom: 'Blfrtip',
                    buttons: {
                        buttons: [

                            {extend: 'csv', footer: true, exportOptions: {columns: [0, 1,2,3,4.5]}},
                            {extend: 'excel', footer: true, exportOptions: {columns:  [0, 1,2,3,4,5]}},
                            {extend: 'print', footer: true, exportOptions: {columns:  [0, 1,2,3,4,5]}}
                        ]
                    }
                });
                $('#branches-table_wrapper').removeClass('form-inline');
            }
        });
    </script>
@endsection
