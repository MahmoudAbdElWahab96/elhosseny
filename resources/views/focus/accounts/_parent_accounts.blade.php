<div class='form-group'>
    {{ Form::label( 'cost_centers', trans('accounts.cost_centers'),['class' => 'col-lg-2 control-label']) }}
    <div class='col-lg-10'>
        <select name="cost_centers" class='form-control'>
            @foreach($account_types as $row)
                <option value="{{$row}}">{{$row}}</option>
            @endforeach
        </select>

    </div>
</div>
