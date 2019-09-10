<div class="panel panel-default">
    <div class="page-panel-title" role="tab" id="heading{{$exam->id}}">
      <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$exam->id}}" aria-expanded="false" aria-controls="collapse{{$exam->id}}">
        <h5>
          {{$exam->exam_name}} <span class="pull-right"><small>@lang('Click to view all courses under this Exam') <i class="material-icons">keyboard_arrow_down</i></small></span>
        </h5>
      </a>
    </div>
    <div id="collapse{{$major->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$major->id}}">
      <div class="panel-body">
        <table class="table table-bordered table-striped">      
          <thead>
            <tr><h4>Majored in {{ ucfirst($major->name) }}</h4></tr>
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
                <a href="{{url('edit/course/'.$course->id)}}" class="btn btn-xs btn-danger">
                  <!-- <i class="material-icons">edit</i> -->
                  @lang('Edit')</a>
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
  </div>
