<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-right col-md-6 col-12">
            <div class="media width-250 float-right">
            </div>
        </div>
    </div>
    <div class="content-body text-right">
        <div class="row" style="padding-top:30px; ">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                
                                <div class="row" style="padding-top: 20px;">
                                    <div class="col-md-4" >
                                        <div  id="my_camera" style="width:50%"></div>
                                        <input type="hidden" name="image" class="image-tag">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class='col-md-3' >
                                        <div class='form-group text-right'>
                                            <label for="increment">{{ trans('general.user_code') }}</label>

                                            <input id="user_code" name="user_code" class="form-control round"
                                                   placeholder="{{ trans('general.user_code') }}"
                                            >{{ old('increment') }}</input>
                                        </div>
                                        <br>
                                        <div class='form-group text-right'>
                                            <label for="employee_name">{{ trans('general.employee_name') }}</label>

                                            <input id="employee_name" class="form-control round"
                                                   placeholder="{{ trans('general.employee_name') }}" disabled
                                            ></input>
                                        </div>
                                        
                                        <div class='form-group text-right'>
                                            <label for="exampleFormControlTextarea1">{{ trans('general.note') }}</label>

                                            <textarea name="note" class="form-control round"
                                                      placeholder="{{ trans('general.note') }}"
                                                      id="exampleFormControlTextarea1" autocomplete='off'
                                                      rows="2">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2">
                                        <div class="row" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"
                                                    id="attendanceIn"
                                            >{{trans('hrms.In')}}</button>
                                        </div>

                                        <div class="row" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"
                                                    id="attendanceOut"
                                            >{{trans('hrms.Out')}}</button>
                                        </div>

                                        <div class="row" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"
                                                    id="attendancePermission"
                                            >{{trans('hrms.Permission')}}</button>
                                        </div>

                                        <div class="row" style="padding-top: 10px;">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"
                                                    id="attendanceReturn"
                                            >{{trans('hrms.Return')}}</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

