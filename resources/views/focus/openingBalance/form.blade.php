<div class='col-md-1'>
    <div class='form-group'>
        <button type="button" name="add" id="add" class="btn btn-success">Add</button>
    </div>
</div>
<div class="row opening">
    <div class='col-md-4'>
        <div class='form-group'>
            {{ Form::label( 'id', trans('transactions.account_id'),['class' => 'col-12 control-label']) }}
            <div class="col">
                <select name="id" class='form-control round' id="accountId">
                    @foreach($openingBalance as $opening)
                        <option value="{{$opening['id']}}">{{$opening['holder'].' '.$opening['number']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class='col-md-4'>
        <div class='form-group'>
            {{ Form::label( 'debit', trans('transactions.debit'),['class' => 'col control-label']) }}
            <div class="col">
                {{ Form::text('debit', numberFormat(0), ['class' => 'form-control round', 'placeholder' => trans('transactions.debit').'*','required'=>'required','onkeypress'=>"return isNumber(event)"]) }}
            </div>
        </div>
    </div>
    <div class='col-md-4'>
        <div class='form-group'>
            {{ Form::label( 'credit', trans('transactions.credit'),['class' => 'col control-label']) }}
            <div class="col">
                {{ Form::text('credit', numberFormat(0), ['class' => 'form-control round', 'placeholder' => trans('transactions.credit').'*','required'=>'required','onkeypress'=>"return isNumber(event)"]) }}</div>
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
        
            $(".OpeningBalance").append(
                `  
            <div class="row opening">
                <div class='col-md-4'>
                    <div class='form-group'>
                        {{ Form::label( 'id', trans('transactions.account_id'),['class' => 'col-12 control-label']) }}
                        <div class="col">
                            <select name="id" class='form-control round' id="accountId">
                                @foreach($openingBalance as $opening)
                                    <option value="{{$opening['id']}}">{{$opening['holder'].' '.$opening['number']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='form-group'>
                        {{ Form::label( 'debit', trans('transactions.debit'),['class' => 'col control-label']) }}
                        <div class="col">
                            {{ Form::text('debit', numberFormat(0), ['class' => 'form-control round', 'placeholder' => trans('transactions.debit').'*','required'=>'required','onkeypress'=>"return isNumber(event)"]) }}
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='form-group'>
                        {{ Form::label( 'credit', trans('transactions.credit'),['class' => 'col control-label']) }}
                        <div class="col">
                            {{ Form::text('credit', numberFormat(0), ['class' => 'form-control round', 'placeholder' => trans('transactions.credit').'*','required'=>'required','onkeypress'=>"return isNumber(event)"]) }}</div>
                    </div>
                </div>
            </div>
            `
            );

        });
        
        $(document).on('click', '.remove-tr', function(){  
                $(this).parents('tr').remove();
        });  
        

        $('#create-openingBalance').on('submit',function(e){
            e.preventDefault();
            
            let arrays = [];
            Array.from(document.querySelectorAll('.opening')).forEach(pay => {
                let ids = pay.querySelector('select[name="id"]');
                let debit = pay.querySelector('input[name="debit"]');
                let credit = pay.querySelector('input[name="credit"]');

                arrays.push([
                    {'id' : ids.value,'debit' : debit.value,'credit' : credit.value}
                ]);
            });
            console.log(arrays);

            $.ajax({
                url: "{{route('biller.opening_balance.store')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    data: arrays,
                },
                success:function(response){
                    location.reload();
                }
            });
        });
    </script>

@endsection
