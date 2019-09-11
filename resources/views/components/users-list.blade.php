{{$users->links()}}
<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      @if(Auth::user()->role == 'admin')
        <!-- @if (!Session::has('section-attendance')) -->
        <th scope="col">@lang('Action')</th>
        <!-- @endif -->
      @endif
      <th scope="col">@lang('Full Name')</th>
      <th scope="col">@lang('Gender')</th>
      @if(Auth::user()->role != 'student')
        <th scope="col">@lang('Code')</th>
      @endif
      <th scope="col">@lang('Email')</th>
      <th scope="col">@lang('Programme')</th>
      @if(Auth::user()->role != 'student')
        <th scope="col">@lang('Qualification')</th>
        <th scope="col">@lang('Major')</th>
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
        <!-- @if (!Session::has('section-attendance')) -->
        <td>
          <a class="btn btn-xs btn-danger" href="{{url('edit/user/'.$user->id)}}">@lang('Edit')</a>
        </td>
        <!-- @endif -->
      @endif
      
        <td><small>{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</small></td>

          <!-- @if(Auth::user()->role != 'student')
            <a href="{{url('user/'.$user->code)}}">
              {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</a>
            </small></td>
          @else
            {{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</small></td>
          @endif -->
          <td><small>
           @if(strtolower($user->gender) == trans('male'))
              <img src="https://png.icons8.com/dusk/50/000000/user.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @else
              <img src="https://png.icons8.com/dusk/50/000000/user-female.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @endif
          </small></td>

        @if(Auth::user()->role != 'student')
          <td><small>{{$user->code}}</small></td>
        @endif
          <td><small>{{$user->email}}</small></td>
          <td><small>{{ucfirst($user->programme->name)}}</small></td>          
        @if(Auth::user()->role != 'student')
          <td><small>@if (ucfirst($user->qualification) != null) {{ucfirst($user->qualification->name)}} @endif</small></td>
          <td><small>@if (ucfirst($user->major) != null) {{ucfirst($user->major->name)}} @endif</small></td>
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
