<div class="table-responsive">
    <small class="text-danger">
        @lang('*Regulation of qualification - successful completion of 360 credits including all compulsory courses of which no more than 135 credits from Level 5 courses and a minimum of 75 credits from Level 7 courses.')
    </small>
    <table class="table table-bordered table-striped table-hover table-condensed">
      <thead class="bg-info text-white">
        <tr>
          <th scope="col">#</th>
          <th scope="col">@lang('Code')</th>
          <th scope="col">@lang('Name')</th>
          <th scope="col">@lang('Level')</th>
          <th scope="col">@lang('Type')</th>
          <th scope="col">@lang('Credits')</th>
          <th scope="col">@lang('Semester')</th>
          <th scope="col">@lang('Grade (if achieved)')</th>
          <th scope="col">@lang('Approved Credits')</th>
        </tr>
      </thead>
      <tbody>
        @if ($classdetails != null)
        @foreach ($classdetails as $classdetail)
        <tr>
            <td scope="row">
                @if ($classdetail->credit == 0 && $classdetail->grade == null)
                <label class="checkbox-label">&nbsp;
                <input type="checkbox" name="" class="course_checkbox" data-coursecode="" checked disabled/>
                <span class="checkmark"></span>
                </label>
                @endif
            </td>
            <td scope="row"><small>{{$classdetail->course->code}}</small></td>
            <td scope="row"><small>{{$classdetail->course->name}}</small></td>
            <td scope="row"><small>{{ucfirst($classdetail->course->level)}}</small></td>
            <td scope="row"><small>{{ucfirst($classdetail->course->type)}}</small></td>
            <td scope="row"><small>{{$classdetail->course->credit}}</small></td>
            <td scope="row"><small>{{$classdetail->term}}</small></td>
            <td scope="row">
                <small>
                @if ($classdetail->grade != null)
                    {{$classdetail->grade->grade}}
                @endif
                </small>
            </td>
            <td scope="row"><small>{{$classdetail->approved_credit}}</small></td>
        </tr>
        @endforeach
        @endif
        <tr>
            <th class="bg-info text-white" colspan="8">Total Courses</th>
            <th class="bg-info text-white" colspan="8">{{$totalCredits}}</th>
        </tr>
      </tbody>
    </table>
</div>

<style>
.checkbox-label {
  position: relative;
  padding-left: 35px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.checkbox-label input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #0000004d;
  border-radius: 15px;
}

.checkbox-label:hover input ~ .checkmark {
  background-color: #ccc;
}

.checkbox-label input:checked ~ .checkmark {
  background-color: #E74C3C;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.checkbox-label input:checked ~ .checkmark:after {
  display: block;
}

.checkbox-label .checkmark:after {
  left: 10px;
  top: 6px;
  width: 5px;
  height: 10px;
  border: solid #fff;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>