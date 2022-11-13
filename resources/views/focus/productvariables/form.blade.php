<div class='form-group'>
    {{ Form::label( 'name', trans('productvariables.name'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-3'>
        {{ Form::text('name', null, ['class' => 'form-control round', 'id' => 'name', 'placeholder' => trans('productvariables.name')]) }}
    </div>
</div>

<span style="background-color: #404e67;color:white">@lang('productvariables.values')</span>

<div class="ProductVAriable">

    <div class="row opening">
        <!-- <div class='col-md-4'>
            <div class='form-group'>
                {{ Form::label( 'variable_name', trans('transactions.variable_name'),['class' => 'col control-label']) }}
                <div class="col">
                    {{ Form::text('variable_name', null, ['class' => 'form-control round', 'placeholder' => trans('transactions.variable_name').'*','required'=>'required']) }}
                </div>
            </div>
        </div> -->
        <div class='col-md-4'>
            <div class='form-group'>
                {{ Form::label( 'variable_value', trans('productvariables.variable_value'),['class' => 'col control-label']) }}
                <div class="col">
                    {{ Form::text('variable_value', null, ['class' => 'form-control round', 'placeholder' => trans('productvariables.variable_value').'*','required'=>'required']) }}
                </div>
            </div>
        </div>

        <div class='col-md-1'>
            <div class='form-group'>
                <button type="button" name="add" id="add" class="btn btn-success" style="    width: 10px;
        height: 10px; margin-top: 30px;">+</button>
            </div>
        </div>
    </div>
</div>

@section("after-scripts")
    {{ Html::script('focus/js/select2.min.js') }}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script type="text/javascript">
        
        $(document).ready(function () {
            // $("#accountId").select2();
        });
        var i = 0;
            
        $("#add").click(function(){
            ++i;
        
            $(".ProductVAriable").append(
                `  
            <div class="row opening">
                <div class='col-md-4'>
                    <div class='form-group'>
                        {{ Form::label( 'variable_value', trans('productvariables.variable_value'),['class' => 'col control-label']) }}
                        <div class="col">
                            {{ Form::text('variable_value', null, ['class' => 'form-control round', 'placeholder' => trans('productvariables.variable_value').'*','required'=>'required']) }}
                        </div>
                    </div>
                </div>
                <button type="button" name="remove" id="remove-tr" class="btn btn-success remove-tr" style="background: saddlebrown;
    width: 10px;
    height: 0px;
    margin-top: 30px;
    margin-right: 13px;">-</button>
            </div>
            `
            );

        });
        
        $(document).on('click', '.remove-tr', function(e){
            e.preventDefault();

            $(this).parent('div').remove();
        });  
        

        $('#create-productvariable').on('submit',function(e){
            e.preventDefault();
            
            let arrays = [];
            Array.from(document.querySelectorAll('.opening')).forEach(pay => {
                let variableValues = pay.querySelector('input[name="variable_value"]');

                arrays.push(
                   variableValues.value
                );
            });
            console.log(arrays);

            $.ajax({
                url: "{{route('biller.productvariables.store')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    data: arrays,
                    name : $('#name').val(),
                },
                success:function(response){
                    location.reload();
                }
            });
        });
    </script>

@endsection
