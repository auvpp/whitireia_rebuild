<div class="panel panel-default">
  @foreach ($majors as $major)
    <div class="page-panel-title" role="tab" id="heading{{$major->id}}">
      <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$major->id}}" aria-expanded="false" aria-controls="collapse{{$major->id}}">
        <h4>
          {{ucfirst($major->name)}} <span class="pull-right"><small>@lang('Click to view all courses under this major') <i class="material-icons">keyboard_arrow_down</i></small></span>
        </h4>
      </a>
    </div>
    <div id="collapse{{$major->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$major->id}}">
      <div class="panel-body table-responsive">
        <table class="table table-bordered table-striped table-data-div table-hover"> 
          <thead>
            <tr>
              @if(Auth::user()->role == 'admin')
              <th scope="col">@lang('Action')</th>
              @endif
              <th scope="col">@lang('Course Code')</th>
              <th scope="col">@lang('Course Name')</th>
              <!-- <th scope="col">@lang('Teacher')</th> -->
              <th scope="col">@lang('Compulsory / Elective')</th>
              <th scope="col">@lang('Current Offered')</th>
              <th scope="col">@lang('Next Offered')</th>
              <th scope="col">@lang('Prerequisites')</th>
              <th scope="col">@lang('Credits')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($major->courses as $course)
            <tr>
              @if(Auth::user()->role == 'admin')
              <td>
                <!-- <a href="{{--url('edit/course/'.$course->id)--}}" class="btn btn-xs btn-danger">
                   <i class="material-icons">edit</i> @lang('Edit')</a> -->
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#adminCourseModal{{$course->id}}">@lang('Edit')</button>
                <!-- Modal -->
                <div class="modal fade" id="adminCourseModal{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="adminCourseModal{{$course->id}}Label">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #5cb85c; color:white !important;">          
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="adminCourseModal{{$course->id}}Label">@lang('Manage Course')</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" action="{{url('edit/course/'.$course->id)}}" method="post">
                          {{csrf_field()}}
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseCode{{$course->id}}" class="control-label">@lang('Course Code :')</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" name="code" class="form-control" id="adminCourseCode{{$course->id}}" value="{{$course->code}}" required>
                            </div>                                  
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseName{{$course->id}}" class="control-label">@lang('Course Name :')</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" name="name" class="form-control" id="adminCourseName{{$course->id}}" value="{{$course->name}}" required>
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseCompulsory{{$course->id}}" class="control-label">@lang('Compulsory / Elective :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="compulsory" class="form-control" id="adminCourseCompulsory{{$course->id}}" value="@if ($course->compulsory == 1) Compulsory @else Elective @endif " required>
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseCredit{{$course->id}}" class="control-label">@lang('Credits :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="credit" class="form-control" id="adminCourseCredit{{$course->id}}" value="{{$course->credit}}" required>
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCoursePrerequisite{{$course->id}}" class="control-label">@lang('Prerequisites :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="prerequisite" class="form-control" id="adminCoursePrerequisite{{$course->id}}" value="{{$course->prerequisite}}">
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseTeacher{{$course->id}}" class="control-label">@lang('Tutor :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="teacher" class="form-control" id="adminCourseTeacher{{$course->id}}" value="{{$course->teacher_id}}">
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseCurrent{{$course->id}}" class="control-label">@lang('Current Offered :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="current_offered" class="form-control" id="adminCourseCurrent{{$course->id}}" value="{{$course->current_offered.' '.$course->current_offered_year}}">
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseNext{{$course->id}}" class="control-label">@lang('Next Offered :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="next_offered" class="form-control" id="adminCourseNext{{$course->id}}" value="{{$course->next_offered.' '.$course->next_offered_year}}">
                            </div>
                          </div>
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                              <label for="adminCourseDescription{{$course->id}}" class="control-label">@lang('Description :')</label>
                            </div>
                            <div class="col-sm-8">
                              <textarea class="form-control" name="description" rows="2" id="adminCourseDescription{{$course->id}}" value="{{$course->description}}"></textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-danger btn-sm">@lang('Save')</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>              
              @endif
              <td><small>{{$course->code}}</small></td>
              <td><small>{{$course->name}}</small></td>
              <!-- <td><small>{{--$course->teacher_id--}}</small></td> -->
              <td><small>
                @if ($course->compulsory == 1)
                  Compulsory
                @else
                  Elective
                @endif
              </small></td>
              <td><small>{{$course->current_offered.' '.$course->current_offered_year}}</small></td>
              <td><small>{{$course->next_offered.' '.$course->next_offered_year}}</small></td>
              <td><small>{{$course->prerequisite}}</small></td>
              <td><small>{{$course->credit}}</small></td>      
            </tr>
            @endforeach    
          </tbody>
        </table>
      </div>
    </div>
  @endforeach
</div>

