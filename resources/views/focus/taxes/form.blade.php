<div class='form-group'>
    {{ Form::label( 'Desc_en', trans('taxes.Desc_en'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('Desc_en', null, ['class' => 'form-control round', 'placeholder' => trans('taxes.Desc_en'),'required'=>'']) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'Desc_ar', trans('taxes.Desc_ar'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('Desc_ar', null, ['class' => 'form-control round', 'placeholder' => trans('taxes.Desc_ar'),'required'=>'']) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'code', trans('taxes.code'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('code', null, ['class' => 'form-control round', 'placeholder' => trans('taxes.code'),'required'=>'']) }}
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
