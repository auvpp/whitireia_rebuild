<!-- Modal for add a new teacher -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="addTeacherModalLabel">@lang('Add A New Teacher')</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="{{url('settings/addteacher')}}" method="post">
                {{csrf_field()}}                    
                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addTeacherCode" class="pull-right control-label">@lang('Code :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="code" class="form-control" id="addTeacherCode" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addTeacherEmail" class="pull-right control-label">@lang('Email :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="email" class="form-control" id="addTeacherEmail" required>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addTeacherFName" class="pull-right control-label">@lang('First Name :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="first_name" class="form-control" id="addTeacherFName" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addTeacherPhoneNumber" class="pull-right control-label">@lang('Phone Number :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="phone_number" class="form-control" id="addTeacherPhoneNumber" required>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addTeacherLName" class="pull-right control-label">@lang('Last Name :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="last_name" class="form-control" id="addTeacherLName" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addTeacherAddress" class="pull-right control-label">@lang('Address :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="address" class="form-control" id="addTeacherAddress">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addTeacherGender" class="pull-right control-label">@lang('Gender :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addTeacherGender" name="gender" required>
                                <option value="Male">@lang('Male')</option>
                                <option value="Female">@lang('Female')</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addTeacherProgramme" class="pull-right control-label">@lang('Programme :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addTeacherProgramme" name="programme_id" required>
                                <option selected disabled>@lang('Select Programme')</option>
                            @foreach ($programmes as $p)
                                <option value="{{$p->id}}">{{ucfirst($p->name)}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addTeacherAbout" class="pull-right control-label">@lang('About :')</label>
                        </div>
                        <div class="col-sm-10">
                            <textarea style="width:100%" class="form-control" name="about" rows="1" id="addTeacherAbout"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger btn-sm">@lang('Save')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>