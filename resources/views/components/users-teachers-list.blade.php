<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <!-- table-date-div is for the search textbox -->
  <button class="btn btn-xs btn-info" id="btnPrintTeacher"><i class="material-icons">print</i> @lang('Print Form')</button>
  <thead>
    <tr class="bg-primary text-white">
      <th scope="col">@lang('Full Name')</th>
      @if(Auth::user()->role != 'student')
        <th scope="col">@lang('Code')</th>
      @endif
      <th scope="col">@lang('Department')</th>
      <th scope="col">@lang('Email')</th>
      @if(Auth::user()->role != 'student')
        <th scope="col">@lang('Phone')</th>
        <th scope="col">@lang('Enrolled Date')</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
        @if(Auth::user()->role == 'admin') 
        <td>
          <a href="#" data-toggle="modal" data-target="#adminUserModal{{$user->id}}">
            <small>
            @if(strtolower($user->gender) == trans('male'))
              <img src="https://png.icons8.com/dusk/50/000000/user.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @else
              <img src="https://png.icons8.com/dusk/50/000000/user-female.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @endif
              {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}
            </small>
          </a>
          <!-- Modal -->
          <div class="modal fade" id="adminUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="adminUserModal{{$user->id}}Label">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header" style="background-color: #5cb85c; color:white !important;">
                          <button class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="adminUserModal{{$user->id}}Label">
                            @lang('Edit - ') <span class="text-primary">
                            @if ($user->role == 'student') Student 
                            @elseif ($user->role == 'teacher') Teacher 
                            @endif
                            </span> - {{$user->code}} &nbsp; &nbsp; &nbsp;
                            <button type="submit" class="btn btn-warning btn-xs" form="formResetTeacher{{$user->id}}">@lang('Reset Password')</a>
                          </h4>
                          <form id="formResetTeacher{{$user->id}}" action="{{url('user/password/reset')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$user->id}}"/>
                          </form>
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
                              <input style="width:100%" name="first_name" class="form-control" id="adminUserFName{{$user->id}}" value="{{$user->first_name}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserCode{{$user->id}}" class="pull-right control-label">@lang('Code :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" name="code" class="form-control" id="adminUserCode{{$user->id}}" value="{{$user->code}}" required>
                            </div>
                            
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserLName{{$user->id}}" class="pull-right control-label">@lang('Last Name :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" name="last_name" class="form-control" id="adminUserLName{{$user->id}}" value="{{$user->last_name}}" required>
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
                              <input style="width:100%" name="email" class="form-control" id="adminUserEmail{{$user->id}}" value="{{$user->email}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserProgramme{{$user->id}}" class="pull-right control-label">@lang('Department :')</label>
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
                              <input style="width:100%" name="phone_number" class="form-control" id="adminUserPhoneNumber{{$user->id}}" value="{{$user->phone_number}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserAddress{{$user->id}}" class="pull-right control-label">@lang('Address :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" name="address" class="form-control" id="adminUserAddress{{$user->id}}" value="{{$user->address}}">
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminUserDate{{$user->id}}" class="pull-right control-label">@lang('Enrolled Date :')</label>
                            </div>
                            <div class="col-sm-4">
                                <input style="width:100%" name="enrolled_date" class="form-control" id="adminUserDate{{$user->id}}" value="{{$user->enrolled_date}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminUserAbout{{$user->id}}" class="pull-right control-label">@lang('About :')</label>
                            </div>
                            <div class="col-sm-4">
                              <textarea style="width:100%" class="form-control" name="about" rows="1" id="adminUserAbout{{$user->id}}" value="{{$user->about}}"></textarea>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <a href="{{url('selectionlist/teacher/'.$user->id)}}" type="button" class="btn btn-primary pull-left">@lang('View Courses')</a>
                            <button class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
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
      @else
        <td><small>
          @if(strtolower($user->gender) == trans('male'))
            <img src="https://png.icons8.com/dusk/50/000000/user.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
          @else
            <img src="https://png.icons8.com/dusk/50/000000/user-female.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
          @endif
          {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}
        </small></td>
      @endif

      @if(Auth::user()->role != 'student')
        <td><small>{{$user->code}}</small></td>
      @endif
        <td><small>{{ucfirst($user->programme->name)}}</small></td> 
        <td><small>{{$user->email}}</small></td>          
      @if(Auth::user()->role != 'student')
        <td><small>{{$user->phone_number}}</small></td>
        <td><small>{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</small></td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{--$users->links()--}}

<script>
  $("#btnPrintTeacher").on("click", function () {
    var printWindow = window.open('', '', 'height=720,width=1280');
    printWindow.document.write('<html><head>');
    printWindow.document.write('<link href="{{url('css/app.css')}}" rel="stylesheet">');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<div class="container"><div class="col-md-12" id="academic-part"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">@lang('Tutors')</h4><table style="text-align:left;border-collapse:collapse;border:1px solid black;"><thead><tr><th style="border: 1px solid black;">@lang('Full Name')</th><th style="border: 1px solid black;">@lang('Gender')</th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;">@lang('Code')</th>@endif<th style="border: 1px solid black;">@lang('Department')</th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;">@lang('Phone')</th>@endif<th style="border: 1px solid black;">@lang('Email')</th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;">@lang('Enrolled Date')</th>@endif</tr></thead><tbody>@foreach ($users as $user)<tr><td style="border: 1px solid black;">{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</td><td style="border: 1px solid black;">{{ucfirst($user->gender)}}</td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;">{{$user->code}}</td>@endif<td style="border: 1px solid black;">{{ucfirst($user->programme->name)}}</td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;">{{$user->phone_number}}</td>@endif<td style="border: 1px solid black;">{{$user->email}}</td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;">{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</td>@endif</tr>@endforeach</tbody></table></div></div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  });
</script>