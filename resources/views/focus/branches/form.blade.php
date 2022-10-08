<div class="form-group">
    <div class='form-group'>
        {{ Form::label( 'company', trans('hrms.company'),['class' => 'col control-label']) }}
        <div class='col'>
            <select name="company_id" class="form-control mb-1">
                <option value=""></option>
                @foreach($companies as $company)
                <option value="{{$company->id}}" @if(@$branches->company_id == $company->id) selected @endif>{{$company->cname}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'name', trans('hrms.branch'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.branch')]) }}
        </div>
    </div>

    <div class='form-group'>
        {{ Form::label( 'city', trans('hrms.city'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.city')]) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'region', trans('hrms.state'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('region', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.state')]) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'country', trans('hrms.country'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.country')]) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'postbox', trans('hrms.postal'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('postbox', null, ['class' => 'form-control box-size', 'placeholder' => trans('hrms.postal')]) }}
        </div>
    </div>

    <div class='form-group'>
        {{ Form::label( 'email', trans('general.email'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('general.email')]) }}
        </div>
    </div>
    <div class='form-group'>
        {{ Form::label( 'phone', trans('general.phone'),['class' => 'col control-label']) }}
        <div class='col'>
            {{ Form::text('phone', null, ['class' => 'form-control box-size', 'placeholder' => trans('general.phone')]) }}
        </div>
    </div>

    <div class='form-group'>
        <input type="checkbox" class="" name="is_active" id="is_active"
            value="1" @if(isset($branches) && $branches['is_active'] == 0) @else checked @endif>
        <label class="" for="is_active">{{trans('costcenters.active')}}</label>
    </div>

</div>

