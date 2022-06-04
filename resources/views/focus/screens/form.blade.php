<div class='form-group'>
    {{ Form::label( 'name_en', trans('screens.name_en'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('name_en', null, ['class' => 'form-control round', 'placeholder' => trans('screens.name_en'),'required'=>'']) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'name_ar', trans('screens.name_ar'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('name_ar', null, ['class' => 'form-control round', 'placeholder' => trans('screens.name_ar'),'required'=>'']) }}
    </div>
</div>
<div class='form-group'>
    {{ Form::label( 'code', trans('screens.code'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        {{ Form::text('code', null, ['class' => 'form-control round', 'placeholder' => trans('screens.code'),'required'=>'']) }}
    </div>
</div>

<div class='form-group'>
    {{ Form::label( 'method', trans('screens.type'),['class' => 'col-12 control-label']) }}
    <div class="d-inline-block custom-control custom-checkbox mr-1">
        <input type="radio" class="custom-control-input bg-primary" name="type" id="colorCheck1"
               value="0"  @if(isset($screens) && $screens['type'] == 0) checked @endif
               @if(!isset($screens)) checked @endif>
        <label class="custom-control-label" for="colorCheck1">None</label>
    </div>
    <div class="d-inline-block custom-control custom-checkbox mr-1">
        <input type="radio" class="custom-control-input bg-success" name="type" value="1"
               @if(isset($screens) && $screens['type'] == 1) checked @endif
               id="colorCheck2">
        <label class="custom-control-label" for="colorCheck2">{{trans('customers.customer')}}</label>
    </div>
    <div class="d-inline-block custom-control custom-checkbox mr-1">
        <input type="radio" class="custom-control-input bg-purple" name="type" value="2"
               @if(isset($screens) && $screens['type'] == 2) checked @endif

               id="colorCheck3">
        <label class="custom-control-label" for="colorCheck3">{{trans('suppliers.supplier')}}</label>
    </div>
    <div class="d-inline-block custom-control custom-checkbox mr-1">
        <input type="radio" class="custom-control-input bg-blue-grey" name="type" value="3"
               @if(isset($screens) && $screens['type'] == 3) checked @endif
               id="colorCheck4">
        <label class="custom-control-label" for="colorCheck4">{{trans('hrms.employee')}}</label>
    </div>
</div>
<div class='form-group'>
        <input type="checkbox" class="" name="active" id="active"
               value="1" @if(isset($screens) && $screens['active'] == 0) @else checked @endif>
        <label class="" for="active" >{{trans('screens.active')}}</label>
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
