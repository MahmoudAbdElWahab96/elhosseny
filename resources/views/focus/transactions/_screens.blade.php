<!-- <div class='form-group'>
    {{ Form::label( 'screens', trans('accounts.cost_centers'),['class' => 'col-6 control-label']) }}
    <div class='col'>
        {{ Form::text('screens', $resource->holder ?? '', ['class' => 'form-control round', 'placeholder' => trans('accounts.cost_centers'),'autocomplete'=>'off', 'disabled']) }}
    </div>
</div> -->
@foreach ($data as $item)
    <div class='form-group'>
        {{ Form::label( 'cost_centers', $item['screen'],['class' => 'col-lg-2 control-label']) }}
        <div class='col-lg-10'>
            <select name="cost_centers[]" class='form-control' id="cost_centers">
                <option value="">قم بالاختيار</option>
                @foreach($item['cost_centers'] as $key => $val)
                    <option value="{{$key}}">{{$val}}</option>
                @endforeach
            </select>

        </div>
    </div>
@endforeach
<script>
    $('#cost_centers').select2();
</script>