<div class="table-responsive">
 
  <form id="" action="{{url('exams/activate-exam')}}" method="POST">
    {{csrf_field()}}
  </form>
  
  <table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
      <tr>
      <tr><th class="bg-success text-white" colspan="9">Compulsory Courses</th></tr>
        <!-- <th scope="col">#</th> -->
        <th scope="col">@lang('Select')</th>
        <th scope="col">@lang('Course Code')</th>
        <th scope="col">@lang('Course Name')</th>
        <th scope="col">@lang('Course Level')</th>
        <th scope="col">@lang('Credits')</th>
        <th scope="col">@lang('Current Offered')</th>
        <th scope="col">@lang('Next Offered')</th>
        <th scope="col">@lang('Prerequisites')</th>
        <th scope="col">@lang('Grade (if achieved)')</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($courses as $course)
      <!-- @if ($course->type == 'Compulsory' && $course->current_offered != 'No longer offered')
        @if (($course->current_offered == 'Not offered' ^ $course->next_offered == 'Not offered') ||
             ($course->current_offered != 'Not offered' && $course->next_offered != 'Not offered'))
             @endif
      @endif -->
      @if ($course->type == 'Compulsory')
      <tr>
        <!-- <th scope="row">{{--($loop->index + 1)--}}</th> -->
        <td scope="row">
          @if ($course->current_offered != 'Not offered')
            @if ($course->current_offered != 'No longer offered')
            <!-- <input type="hidden" name="exam_id" value="" form="form"/> -->
            <label class="checkbox-label">&nbsp;
              <input type="checkbox" name="notice_published" id="" form="form"/>
              <span class="checkmark"></span>
            </label>
            @endif
          @endif
        </td>
        <td scope="row"><a href="#" data-toggle="modal" data-target="#selectionCourseModal{{$course->id}}"><small>{{$course->code}}</small></a></td>
        <td scope="row"><a href="#" data-toggle="modal" data-target="#selectionCourseModal{{$course->id}}"><small>{{ucfirst($course->name)}}</small></a></td>
        <td scope="row"><small>{{$course->level}}</small></td>
        <td scope="row"><small>{{$course->credit}}</small></td>
        <td scope="row"><small>{{$course->current_offered}}</small></td>
        <td scope="row"><small>{{$course->next_offered}}</small></td>
        <td scope="row"><small>{{$course->prerequisite}}</small></td>
        <td scope="row"><small></small></td>
      </tr>
      @endif
      
      <!-- Modal -->
      <div class="modal fade" id="selectionCourseModal{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="selectionCourseModal{{$course->id}}Label">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #5cb85c; color:white !important;">          
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="selectionCourseModal{{$course->id}}Label">@lang('Course Information')</h4>
            </div>
            <div class="modal-body">
              <div class="row" style="margin-bottom:7px;">
                <div class="col-sm-4">
                  <label for="selectionCourseTeacher{{$course->id}}" class="pull-right control-label">@lang('Tutor :')</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="selectionCourseTeacher{{$course->id}}" class="form-control" value="{{$course->teacher}}" readonly>
                </div>                
              </div>
              <div class="row" style="margin-bottom:7px;">
                <div class="col-sm-4">
                  <label for="selectionCourseDesc{{$course->id}}" class="pull-right">@lang('Description :')</label>
                </div>
                <div class="col-sm-8">
                  <textarea rows="5" id="selectionCourseDesc{{$course->id}}" class="form-control" readonly>{{$course->description}}</textarea>
                </div>                
              </div>
            </div>    
            <div class="modal-footer">
              <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
  
  <table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
      <tr>
        <tr><th class="bg-warning" colspan="9">Elective Courses</th></tr>
        <th scope="col">@lang('Select')</th>
        <th scope="col">@lang('Course Code')</th>
        <th scope="col">@lang('Course Name')</th>
        <th scope="col">@lang('Course Level')</th>
        <th scope="col">@lang('Credits')</th>
        <th scope="col">@lang('Current Offered')</th>
        <th scope="col">@lang('Next Offered')</th>
        <th scope="col">@lang('Prerequisites')</th>
        <th scope="col">@lang('Grade (if achieved)')</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($courses as $course)
      @if ($course->type == 'Elective')
      <tr>
        <td scope="row">
          @if ($course->current_offered != 'Not offered')
           @if ($course->current_offered != 'No longer offered')
            <!-- <input type="hidden" name="exam_id" value="" form="form"/> -->
            <label class="checkbox-label">&nbsp;
              <input type="checkbox" name="notice_published" form="form" />
              <span class="checkmark"></span>
            </label>
            @endif
          @endif
        </td>
        <td scope="row"><a href="#" data-toggle="modal" data-target="#selectionCourseModal{{$course->id}}"><small>{{$course->code}}</small></a></td>
        <td scope="row"><a href="#" data-toggle="modal" data-target="#selectionCourseModal{{$course->id}}"><small>{{ucfirst($course->name)}}</small></a></td>
        <td scope="row"><small>{{$course->level}}</small></td>
        <td scope="row"><small>{{$course->credit}}</small></td>
        <td scope="row"><small>{{$course->current_offered}}</small></td>
        <td scope="row"><small>{{$course->next_offered}}</small></td>
        <td scope="row"><small>{{$course->prerequisite}}</small></td>
        <td scope="row"><small></small></td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
  <div >
    <input type="submit" class="btn btn-info pull-left" style="margin-left: 1%;" value="@lang('Submit')" form="form"/> 
  </div>

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
