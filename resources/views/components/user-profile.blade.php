<div class="row">
  <div class="col-md-8" id="main-container">
    <div class="row" style="margin-bottom:7px;">
      <h3><span class="label label-danger">{{ucfirst($user->role)}}</span> <span class="label label-default">{{$user->code}}</span></h3>
    </div>
    <form class="form-horizontal" action="{{url('edit/user')}}" method="post">
      {{csrf_field()}}
      
      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileName" class="pull-right control-label">@lang('Full Name :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" class="form-control" id="profileName" value="{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}" disabled>
        </div>
      </div>

      @if (\Auth::user()->role != 'student')
      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileDepartment" class="pull-right control-label">@lang('Department :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" class="form-control" id="profileDepartment" value="{{$user->programme->name}}" disabled>
        </div>
      </div>
      @else
      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileProgramme" class="pull-right control-label">@lang('Programme :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" class="form-control" id="profileProgramme" value="{{$user->programme->name}}" disabled>
        </div>
      </div>

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileQualification" class="pull-right control-label">@lang('Qualification :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" class="form-control" id="profileProprofileQualificationgramme" value="{{$user->qualification->name}}" disabled>
        </div>
      </div>

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileMajor" class="pull-right control-label">@lang('Major :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" class="form-control" id="profileMajor" value="{{$user->major->name}}" disabled>
        </div>
      </div>
      @endif

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileDate" class="pull-right control-label">@lang('Enrolled Date :')</label>
        </div>
        <div class="col-sm-6">
            <input style="width:100%" class="form-control" id="profileDate" value="{{$user->enrolled_date}}" disabled>
        </div>
      </div>

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileEmail" class="pull-right control-label">@lang('Email :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" class="form-control" id="profileEmail" value="{{$user->email}}" disabled>
        </div>
      </div>

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profilePhoneNumber" class="pull-right control-label">@lang('Phone Number :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" name="phone_number" class="form-control" id="profilePhoneNumber" value="{{$user->phone_number}}" required>
        </div>
      </div>

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <label for="profileAddress" class="pull-right control-label">@lang('Address :')</label>
        </div>
        <div class="col-sm-6">
          <input style="width:100%" name="address" class="form-control" id="profileAddress" value="{{$user->address}}">
        </div>
      </div>

      <div class="row" style="margin-bottom:7px;">
        <div class="col-sm-3">
          <a href="{{url()->previous()}}" type="button" class="btn btn-sm btn-warning">@lang('Go Back')</a>
        </div>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-danger btn-sm pull-right">@lang('Save')</button>
        </div>
      </div>

      <input type="hidden" name="id" value="{{$user->id}}" required>
      <input type="hidden" name="code" value="{{$user->code}}" required>
      <input type="hidden" name="first_name" value="{{$user->first_name}}" required>
      <input type="hidden" name="last_name" value="{{$user->last_name}}" required>
      <input type="hidden" name="gender" value="{{$user->gender}}" required>
      <input type="hidden" name="programme_id" value="{{$user->programme_id}}" required>
      <input type="hidden" name="qualification_id" value="{{$user->qualification_id}}">
      <input type="hidden" name="major_id" value="{{$user->major_id}}">
      <input type="hidden" name="enrolled_date" value="{{$user->enrolled_date}}" required>
      <input type="hidden" name="about" value="{{$user->about}}">
      <input type="hidden" name="email" value="{{$user->email}}" required>
      
    </form>
  </div>
</div>
