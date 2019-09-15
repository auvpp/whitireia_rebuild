<div class="table-responsive">
 
  <form action="{{url('courses/selection')}}" method="POST">
    {{csrf_field()}}
    <table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr><th class="bg-dark text-white" colspan="9">Compulsory Courses</th></tr>
        <tr>      
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
                <input type="checkbox" name="course{{$course->id}}" value="{{$course->id}}" class="course_checkbox"/>
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
        
        <!-- Modal for Course Information -->
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
        <tr><th class="bg-warning" colspan="9">Elective Courses</th></tr>
        <tr>
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
                <input type="checkbox" name="course{{$course->id}}" value="{{$course->id}}" class="course_checkbox" />
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
   
    <input type="button" id="submitButton{{$course->id}}" class="btn btn-info pull-left" style="margin-left: 1%;" value="Submit"/>
    
    <!-- Modal for Courses Confirmation -->
    <div class="modal fade" id="confirmCourseModal{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmCourseModal{{$course->id}}Label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">          
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="confirmCourseModal{{$course->id}}Label">@lang('Course Confirmation')</h4>
          </div>
          <div class="modal-body">
            <div class="row" style="margin-bottom:7px;">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <h4><b>@lang('According to the requirements of Immigration New Zealand , each ')
                  <span class="text-danger">@lang('international student ')</span>@lang('must select ')
                  <span class="text-danger">@lang('NO LESS THAN 2 COURSES ')</span>@lang('per trimester .')</b>
                </h4>
                <br>
                <h4><b>@lang('Once you have confirmed your course selection, you can ')
                  <span class="text-danger">@lang('ONLY ')</span>@lang('contact the administrator to make changes within the specified time.')</b>
                </h4>
                <br>
                <h4><b>@lang('Are you sure about your course selction ?')</b></h4>

              </div>    
            </div>
          </div>    
          <div class="modal-footer">
            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" >@lang('Close')</button>
            <button type="submit" class="btn btn-danger btn-sm">@lang('Confirm')</button>
          </div>
        </div>
      </div>
    </div>

  </form>
</div>

<!-- Modal for warning information (if the user selects more than 4 courses) -->
<div class="modal fade" id="warnCourseModal{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="warnCourseModal{{$course->id}}Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning" >          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="warnCourseModal{{$course->id}}Label">@lang('Notice')</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom:7px;">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <h4><b>@lang('We do not recommend that you choose more than 4 courses ...')</b></h4>
            <h4><b>@lang('because you are likely to encounter the course clash .')</b></h4>
          </div>    
        </div>
      </div>    
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" >@lang('Close')</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for error information (if the user didn't select any course) -->
<div class="modal fade" id="errorCourseModal{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="errorCourseModal{{$course->id}}Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white" >          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="errorCourseModal{{$course->id}}Label">@lang('Error')</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom:7px;">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <h4><b>@lang('You did not select any course .')</b></h4>
          </div>    
        </div>
      </div>    
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" >@lang('Close')</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    // set the maximum of the checkbox
    $(".course_checkbox").click( function() {
      if ($(".course_checkbox:checked").length > 4 ) {
          $(this).removeAttr("checked");
          $("#warnCourseModal{{$course->id}}").modal(); 
      }
    });

    // check user's selection before submitting
    $("#submitButton{{$course->id}}").click(function(){
      if ($(".course_checkbox:checked").length < 1) {
          $("#errorCourseModal{{$course->id}}").modal();  
      }else{
          $("#confirmCourseModal{{$course->id}}").modal();  
      }
    });
  });
</script>


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