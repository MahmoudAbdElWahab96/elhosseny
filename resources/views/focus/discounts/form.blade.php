<div class='form-group'>
    {{ Form::label( 'name', trans('discounts.name'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('name', null, ['class' => 'form-control round', 'placeholder' => trans('discounts.name')]) }}
    </div>
</div>
<div class='form-group' id="value1">
    {{ Form::label( 'value', trans('discounts.value'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('value', null, ['class' => 'form-control round', 'placeholder' => trans('discounts.value')]) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label( 'class', trans('terms.type'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select class="form-control round" name="class" id='class_m'>
            @php
                switch (@$discounts['class']){
                case 2  : echo  '<option value="2">--'.trans('general.discount').'--</option>';
                break;
                }
            @endphp
            <option value="2">{{trans('general.discount')}}</option>
        </select>
    </div>
</div>

<div class="form-group">
    {{ Form::label( 'type1', trans('discounts.type1'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select class="form-control round" name="type1" id='type1'>
            @php
                switch (@$discounts['type1']){
                case '%' : echo  '<option value="%">--%-</option>';
                break;
                case 'flat' : echo  '<option value="flat">--'.trans('discounts.flat').'--</option>';
                break;
                 case 'b_flat' : echo  '<option value="b_flat">--'.trans('discounts.b_flat').'--</option>';
                break;
                case 'b_per' : echo  '<option value="b_per">--'.trans('discounts.b_per').'--</option>';
                break;

                }
            @endphp
            <option value="%">%</option>
            <option value="flat">{{trans('discounts.flat')}}</option>

        </select>
    </div>
</div>

<div class="form-group" id="type2">
    {{ Form::label( 'type2', trans('discounts.type2'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select class="form-control round" name="type2">
            @php
                switch (@$discounts['type2']){

                case 'inclusive' : echo  '<option value="inclusive">--'.trans('discounts.inclusive').'--</option>';
                break;
                 case 'exclusive' : echo  '<option value="exclusive">--'.trans('discounts.exclusive').'--</option>';
                break;
                }
            @endphp

            <option value="inclusive">{{trans('discounts.inclusive')}}</option>
            <option value="exclusive">{{trans('discounts.exclusive')}}</option>

        </select>
    </div>
</div>

<div class="form-group" id="type3">
    {{ Form::label( 'type3', trans('discounts.type3'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select class="form-control round" name="type3">
            @php
                switch (@$discounts['type3']){

                case 'inclusive' : echo  '<option value="inclusive">--'.trans('discounts.inclusive').'--</option>';
                break;
                 case 'exclusive' : echo  '<option value="exclusive">--'.trans('discounts.exclusive').'--</option>';
                break;
                 case 'cgst' : echo  '<option value="cgst">--'.trans('discounts.cgst').'--</option>';
                break;
                }
            @endphp

            <option value="inclusive">{{trans('discounts.inclusive')}}</option>
            <option value="exclusive">{{trans('discounts.exclusive')}}</option>
            <option value="cgst">{{trans('discounts.cgst')}}</option>
            <option value="igst">{{trans('discounts.igst')}}</option>

        </select>
    </div>
</div>



@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $(document).ready(function () {
            $("#class_m").on('change', function () {
                if ($(this).val() == '2') {
                    $('#type1').find('option').remove().end().append('<option value="%">%</option><option value="flat">{{trans('discounts.flat')}}</option><option value="b_flat">{{trans('discounts.b_flat')}}</option><option value="b_per">{{trans('discounts.b_per')}}</option>').val('%');
                    $("#type3").hide();
                    $("#type2").hide();
                    $("#value1").hide();
                } else {
                    $('#type1').find('option').remove().end().append('<option value="%">%</option><option value="flat">{{trans('discounts.flat')}}</option>').val('%');
                    $("#type2").show();
                    $("#type3").show();
                    $("#value1").show();
                }

            });


            if ($("#class_m :selected").val() == '2') {
                $('#type1').find('option').remove().end().append('<option value="%">%</option><option value="flat">{{trans('discounts.flat')}}</option><option value="b_flat">{{trans('discounts.b_flat')}}</option><option value="b_per">{{trans('discounts.b_per')}}</option>').val('{{@$discounts['type1']}}');
                $("#type3").hide();
                $("#type2").hide();
                $("#value1").hide();
            }

        });


    </script>
@endsection
