<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <!-- table-date-div is for the search textbox-->
  <!-- table-date-div is for the search textbox-->

  <thead>
    <tr class="bg-primary text-white">
      <th scope="col">#</th>
      @if(Auth::user()->role == 'admin')
        <th scope="col">@lang('Action')</th>
      @endif
      <th scope="col">@lang('Full Name')</th>
      @if(Auth::user()->role != 'student')
        <th scope="col">@lang('Code')</th>
      @endif
      <th scope="col">@lang('Programme')</th>
      <th scope="col">@lang('Email')</th>
      @if(Auth::user()->role != 'student')
        <th scope="col">@lang('Phone')</th>
        <th scope="col">@lang('Address')</th>
        <th scope="col">@lang('Enrolled Date')</th>
        <!-- <th scope="col">@lang('Active')</th> -->
      @endif

      <!-- @foreach ($users as $user)
        @if($user->role == 'student')
          @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            <th scope="col">@lang('Attendance')</th>
            {{--@if (!Session::has('section-attendance'))
            <th scope="col">@lang('Marks')</th>
            @endif --}}
          @endif
            @if (!Session::has('section-attendance'))
            <th scope="col">@lang('Session')</th>
            <th scope="col">@lang('Version')</th>
            <th scope="col">@lang('Class')</th>
            <th scope="col">@lang('Section')</th>
            <th scope="col">@lang('Father')</th>
            <th scope="col">@lang('Mother')</th>
            @endif
        @elseif($user->role == 'teacher')
          @if (!Session::has('section-attendance'))
          <th scope="col">@lang('Email')</th>
          @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            <th scope="col">@lang('Courses')</th>
          @endif
          @endif
        @elseif($user->role == 'accountant' || $user->role == 'librarian')
          @if (!Session::has('section-attendance'))
          <th scope="col">@lang('Email')</th>
          @endif
        @endif
        @break($loop->first)
      @endforeach
      @if (!Session::has('section-attendance'))
      <th scope="col">@lang('Gender')</th>
      <th scope="col">@lang('Blood')</th>
      <th scope="col">@lang('Phone')</th>
      <th scope="col">@lang('Address')</th>
      @endif -->
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{ ($current_page-1) * $per_page + $key + 1 }}</th>
      @if(Auth::user()->role == 'admin') 
        <td>
          <!-- <a class="btn btn-xs btn-danger" href="{{url('edit/user/'.$user->id)}}">@lang('Edit')</a> -->
          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#adminUserModal{{$user->id}}">@lang('Edit')</button>
          <!-- Modal -->
          <div class="modal fade" id="adminUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="adminUserModal{{$user->id}}Label">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header" style="background-color: #5cb85c; color:white !important;">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="adminUserModal{{$user->id}}Label">
                            @lang('Edit - ') <span class="text-primary">
                            @if ($user->role == 'student') Student 
                            @elseif ($user->role == 'teacher') Teacher 
                            @endif
                            </span> - {{$user->code}} &nbsp; &nbsp; &nbsp;
                            <a href="#" type="button" class="btn btn-warning btn-xs">@lang('Rest Password')</a>
                          </h4>
                          
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" action="{{url('edit/user')}}" method="post">
                          {{csrf_field()}}
                          <input type="hidden" name="id" value="{{$user->id}}">
                          
                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserFName{{$user->id}}" class="pull-right control-label">@lang('First Name :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" type="text" name="first_name" class="form-control" id="adminUserFName{{$user->id}}" value="{{$user->first_name}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserCode{{$user->id}}" class="pull-right control-label">@lang('Code :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" type="text" name="code" class="form-control" id="adminUserCode{{$user->id}}" value="{{$user->code}}" required>
                            </div>
                            
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserLName{{$user->id}}" class="pull-right control-label">@lang('Last Name :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" type="text" name="last_name" class="form-control" id="adminUserLName{{$user->id}}" value="{{$user->last_name}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserGender{{$user->id}}" class="pull-right control-label">@lang('Gender :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminUserGender{{$user->id}}" name="gender" required>
                                <option value="Male">@lang('Male')</option>
                                <option value="Female">@lang('Female')</option>
                              </select>
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserEmail{{$user->id}}" class="pull-right control-label">@lang('Email :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" type="text" name="email" class="form-control" id="adminUserEmail{{$user->id}}" value="{{$user->email}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserProgramme{{$user->id}}" class="pull-right control-label">@lang('Programme :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminUserProgramme{{$user->id}}" name="programme_id" required>
                              @foreach ($programmes as $p)
                                <option value="{{$p->id}}">{{ucfirst($p->name)}}</option>
                              @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserPhoneNumber{{$user->id}}" class="pull-right control-label">@lang('Phone Number :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" type="text" name="phone_number" class="form-control" id="adminUserPhoneNumber{{$user->id}}" value="{{$user->phone_number}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserAddress{{$user->id}}" class="pull-right control-label">@lang('Address :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" type="text" name="address" class="form-control" id="adminUserAddress{{$user->id}}" value="{{$user->address}}">
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserDate{{$user->id}}" class="pull-right control-label">@lang('Enrolled Date :')</label>
                            </div>
                            <div class="col-sm-4">
                                <input style="width:100%" type="text" name="enrolled_date" class="form-control" id="adminUserDate{{$user->id}}" value="{{$user->enrolled_date}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserAbout{{$user->id}}" class="pull-right control-label">@lang('About :')</label>
                            </div>
                            <div class="col-sm-4">
                              <textarea style="width:100%" class="form-control" name="about" rows="1" id="adminUserAbout{{$user->id}}" value="{{$user->about}}"></textarea>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <a href="#" type="button" class="btn btn-primary pull-left">@lang('View Courses')</a>
                            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-danger btn-sm">@lang('Save')</button>
                          </div>

                        </form>
                      </div>
                  </div>
              </div>
          </div>
        </td>

        <script>
          $(document).ready(function(){
            $("#adminUserGender{{$user->id}}").val('{{ucfirst($user->gender)}}');
            $("#adminUserProgramme{{$user->id}}").val('{{$user->programme->id}}');

            $("#adminUserDate{{$user->id}}").val('{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}');
            $(function () {
              $('#adminUserDate{{$user->id}}').datepicker({
                  format: "dd-mm-yyyy",
                  // viewMode: "years",
                  // minViewMode: "years",
              });
              $('#adminUserDate{{$user->id}}').datepicker('setDate', "{{ Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y') }}");
            });     
          });
        </script>

      @endif
      
        <td><small>
          @if(strtolower($user->gender) == trans('male'))
            <img src="https://png.icons8.com/dusk/50/000000/user.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
          @else
            <img src="https://png.icons8.com/dusk/50/000000/user-female.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
          @endif
          {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}
        </small></td>

          <!-- @if(Auth::user()->role != 'student')
            <a href="{{url('user/'.$user->code)}}">
              {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</a>
            </small></td>
          @else
            {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</small></td>
          @endif -->
        @if(Auth::user()->role != 'student')
          <td><small>{{$user->code}}</small></td>
        @endif
          <td><small>{{ucfirst($user->programme->name)}}</small></td> 
          <td><small>{{$user->email}}</small></td>          
        @if(Auth::user()->role != 'student')
          <td><small>{{$user->phone_number}}</small></td>
          <td><small>{{$user->address}}</small></td>
          <td><small>{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</small></td>
          <!-- <td><small>{{$user->active}}</small></td> -->
        @endif

      <!-- @if($user->role == 'student')
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
          <td><small><a class="btn btn-xs btn-info" role="button" href="{{url('attendances/0/'.$user->id.'/0')}}">@lang('View Attendance')</a></small></td>
          {{--@if (!Session::has('section-attendance'))
          <td><small><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$user->id)}}">@lang('View Marks')</a></small></td>
          @endif --}}
        @endif
        @if (!Session::has('section-attendance'))
        <td>
          <small>
            {{$user->studentInfo['session']}}
            @if($user->studentInfo['session'] == now()->year || $user->studentInfo['session'] > now()->year)
              <span class="label label-success">@lang('Promoted/New')</span>
            @else
              <span class="label label-danger">@lang('Not Promoted')</span>
            @endif
          </small>
        </td>
        <td><small>{{ucfirst($user->studentInfo['version'])}}</small></td>
        <td><small>{{$user->major->name}} {{!empty($user->group)? '- '.$user->group:''}}</small></td>
        <td style="white-space: nowrap;"><small>{{$user->programme->name}}
          {{-- @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            - <a class="btn btn-xs btn-primary" role="button" href="{{url('courses/0/'.$user->section->id)}}">@lang('All Courses')</a>
          @endif --}}
          </small>
        </td>
        <td><small>{{$user->studentInfo['father_name']}}</small></td>
        <td><small>{{$user->studentInfo['mother_name']}}</small></td>
        @endif
      @elseif($user->role == 'teacher')
        @if (!Session::has('section-attendance'))
        <td>
          <small>{{$user->email}}</small>
        </td>
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <td style="white-space: nowrap;">
          <small>
            <a href="{{url('courses/'.$user->id.'/0')}}">@lang('All Courses')</a>
          </small>
        </td>
        @endif
        @endif
      @elseif($user->role == 'accountant' || $user->role == 'librarian')
        @if (!Session::has('section-attendance'))
        <td>
          <small>{{$user->email}}</small>
        </td>
        @endif
      @endif
      @if (!Session::has('section-attendance'))
      <td><small>{{ucfirst($user->gender)}}</small></td>
      <td><small>{{$user->blood_group}}</small></td>
      <td><small>{{$user->phone_number}}</small></td>
      <td><small>{{$user->address}}</small></td>
      @endif -->
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$users->links()}}
