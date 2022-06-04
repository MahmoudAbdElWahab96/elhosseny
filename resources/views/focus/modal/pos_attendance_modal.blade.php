
@extends ('core.layouts.app')
@section ('title', trans('hrms.attendance_and_eparture'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.accounts.management') }}
        <small>{{ trans('labels.backend.accounts.create') }}</small>
    </h1>
@endsection
@section('content')
    {{ Form::open(['route' => 'biller.hrms.attendanceActionsStore', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post','files' => true, 'id' => 'attendanceActionsStore']) }}
    @csrf
    @include("focus.hrms._attendance_actions_form")

    {{ Form::close() }}
@endsection
@section('extra-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>--}}
    <script>
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        $('#attendanceIn').on('click', function () {

            $("#attendanceActionsStore").append('<input type="hidden" name="attendance_type" value="1">');
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                // document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            });
        });
        $('#attendanceOut').on('click', function () {
            $("#attendanceActionsStore").append('<input type="hidden" name="attendance_type" value="2">');
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                // document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            });
        });
        $('#attendancePermission').on('click', function () {
            $("#attendanceActionsStore").append('<input type="hidden" name="attendance_type" value="3">');
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                // document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            });
        });
        $('#attendanceReturn').on('click', function () {
            $("#attendanceActionsStore").append('<input type="hidden" name="attendance_type" value="4">');
            Webcam.snap(function (data_uri) {
                $(".image-tag").val(data_uri);
                // document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            });
        });
        //get user name by increment code


        $('#user_code').on('change', function (e) {

            var aurl = '{{route('biller.hrms.getUserByCode')}}';
            var obj = $('#employee_name');
            var obj_value = $(this).val();
            $.ajax({
                url: aurl,
                type: 'GET',
                data: {'code': obj_value},
                success: function (data) {
                    obj.val(data);
                },
                error: function (data) {
                    obj.val('');
                }
            });
        });

    </script>
@endsection
