<div class='form-group'>
    {{ Form::label( 'number', trans('accounts.code'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('number', null, ['class' => 'form-control box-size', 'placeholder' => trans('accounts.code').'*','required'=>'required']) }}
    </div>
</div>

<div class='form-group'>
    {{ Form::label( 'holder', trans('accounts.holder'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('holder', null, ['class' => 'form-control box-size', 'placeholder' => trans('accounts.holder').'*','required'=>'required']) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'level', trans('accounts.level'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-10'>
        <select class="form-control box-size" name="level" id="level">
                <option value='' selected>قم باختيار المستوي</option>
                @for($i = 1; $i <= (int)$level; $i++)
                    <option value='{{$i}}' id="{{$i}}" @if($i==@$accounts->level) selected @endif >{{$i}}</option>
                @endfor
        </select>
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'account_type', trans('accounts.account_type'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select name="account_type" class='form-control' id="account_type">
            <option value='' selected>قم باختيار نوع الحساب</option>
            @foreach($account_types as $key => $row)
                <option value="{{$key}}" @if($key==@$accounts->account_type) selected @endif>{{$row}}</option>
            @endforeach
        </select>

    </div>
</div>
<div class='form-group parent_account' style="display:none">
    {{ Form::label( 'parent_account', trans('accounts.parent_account'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select name="parent_account_id" class='form-control'>
        </select>
    </div>
</div>
<!-- <div class='form-group'>
    {{ Form::label( 'balance', trans('accounts.balance'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('balance', null, ['class' => 'form-control box-size', 'placeholder' => trans('accounts.balance'),'onkeypress'=>"return isNumber(event)"]) }}
    </div>
</div> -->
<!-- <div class='form-group'>
    {{ Form::label( 'code', trans('accounts.code'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('code', null, ['class' => 'form-control box-size', 'placeholder' => trans('accounts.code')]) }}
    </div>
</div> -->

<div class='form-group'>
    {{ Form::label( 'account_nature', trans('accounts.account_nature'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select name="account_nature" class='form-control'>
            <option value="1"
                    @if(isset($accounts) && $accounts->account_nature == 1) selected @endif>{{trans('accounts.Debit')}}</option>
            <option value="2"
                    @if(isset($accounts) && $accounts->account_nature == 2) selected @endif>{{trans('accounts.Creditor')}}</option>
        </select>

    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'note', trans('accounts.note'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('note', null, ['class' => 'form-control box-size', 'placeholder' => trans('accounts.note')]) }}
    </div>
</div>
<input type="hidden" name="parentAccountId" id="parentAccountId" value="{{@$accounts->parent_account_id}}">

<div id="screens">
    {{ Form::label( 'cost_centers', trans('accounts.cost_centers'),['class' => 'col-lg-2 control-label']) }}
    <div class='row form-group'>
        <div class='col-lg-9'>
            <select name="cost_centers" class='form-control' id="select_cost_centers">
                @foreach($screens as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class=col-lg-2>
            <button type="button" id="cost_centers" class="btn btn-info">+</button>
        </div>
    </div>
    <table id="screens-table"
           class="table table-striped table-bordered zero-configuration" cellspacing="0"
           width="100%">
        <thead>
        <tr>
            <th>{!! trans('screens.name_en') !!} </th>
            <th>{!! trans('screens.name_ar') !!} </th>
            <th>{!! trans('screens.code') !!} </th>
            <th>{!! trans('screens.action') !!} </th>
        </tr>
        </thead>


        <tbody id="cost_center_screens">
            @if($cost_centers)
                @foreach($cost_centers as $cost_center)
                    <tr id="screen-{{$cost_center->id}}">
                        <td>{{$cost_center->name_en}}</td>
                        <td>{{$cost_center->name_ar}}</td>
                        <td>{{$cost_center->code}}</td>
                        <td>
                            <a class="btn btn-danger round remove" table-method="delete"
                                data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                                data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                                data-trans-title="'.trans('strings.backend.general.are_you_sure').'" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i  class="fa fa-trash"></i>
                            </a>
                        </td>

                        <input type="hidden" name="cost_center_screens[]" value="{{$cost_center->id}}">
                        <input type="hidden" name="cost_center_screens_names[]" value="{{$cost_center->name_ar}}">
                    </tr>
                @endforeach
            @endif            
        </tbody>
    </table>

</div>


@section("after-scripts")

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('#screens').hide();
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $(document).ready(function () {

            $('#screens-table').on('click','.remove', function(){
                Swal.fire({
                    title: 'هل انت متأكد من مسح مركز التكلفه ؟',
                    text: "لا يمكنك الرجوع ف هذا!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'حذف!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('tr').remove();
                    }
                })
            });

            let level = $('#level option:selected').val();

            if(level == {!! $account_level !!} ){
                $('#screens').show();
            }

            //Everything in here would execute after the DOM is ready to manipulated.
            $('#level').on('change', function () {
                var divID = $(this).children('option:selected').attr('id');

                if(divID == {!! $account_level !!}){
                    $('#screens').show();
                } else {
                    $('#screens').hide();
                }
            });

            let account_type_id = $('#account_type option:selected').val();

            if (account_type_id) {
                 $.ajax({
                  url: "{{url('/accounts/cost_centers/')}}/"+account_type_id,
                  type: "GET",
                  dataType: "json",
                  success: function(data){
                    $('.parent_account').css('display','block');
                    $('select[name="parent_account_id"]').empty();
                    $('select[name="parent_account_id"]').append('<option value="">----</option>');
                    $.each(data,function(key,value){
                        if(key == $('#parentAccountId').val()){
                            $('select[name="parent_account_id"]').append('<option value="'+key+'" selected>'+value+'</option>');
                        }else{
                            $('select[name="parent_account_id"]').append('<option value="'+key+'">'+value+'</option>');
                        }
                    });
                  }
                 });
                }else {
                     $('select[name="parent_account_id"]').empty();
               }
        });

        $("#cost_centers").on("click", function (e) {
            let number = $('#screens-table tr').length;
            if(number > 4 ){
                Swal.fire(
                'لا يمكن اضافه اكثر من 4 مراكز تكلفه لهذا الحساب ؟'
                )
            }else{
                var id = $('#select_cost_centers option:selected').val();
                $.ajax({
                    type: "GET",
                    url: '{{ route("biller.accounts.appendScreens") }}',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'هل انت متأكد من اضافه مركز تكلفه لهذا الحساب ؟',
                            text: "لا يمكنك الرجوع ف هذا!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'اضافه'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $('#cost_center_screens').prepend(data);
                                number++;
                            }
                        })
                    }
                });
            }
        });


        $('select[name="account_type"]').on('change',function(){
                var account_type_id= $(this).val();
                console.log(account_type_id)
                if (account_type_id) {
                 $.ajax({
                  url: "{{url('/accounts/cost_centers/')}}/"+account_type_id,
                  type: "GET",
                  dataType: "json",
                  success: function(data){
                    $('.parent_account').css('display','block');
                    $('select[name="parent_account_id"]').empty();
                    $('select[name="parent_account_id"]').append('<option value="">----</option>');
                    $.each(data,function(key,value){
                        $('select[name="parent_account_id"]').append('<option value="'+value.id+'">'+value.code+' - '+value.holder+'</option>');
                    });
                  }
                 });
                }else {
                     $('select[name="parent_account_id"]').empty();
               }
           });
           
    </script>
@endsection
