<!----------Courses------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="container">
    <div class="col-md-12" id="academic-part">
        <h2 style="text-align:center;">{{Auth::user()->school->name}}</h2>
        <h4 style="text-align:center;">{{$major->qualification->name.' ('.$major->name.')'}}</h4>
        <table style="text-align:left;border-collapse:collapse;border:1px solid black;">
            <thead>
                <tr>
                    <th style="border: 1px solid black;"><small>@lang('Course Code')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Course Name')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Course Level')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Course Type')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Credits')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Current Offered')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Next Offered')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Prerequisites')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Tutor')</small></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($major->courses as $course)
            <tr>
                <td style="border: 1px solid black;"><small>{{$course->code}}</small></td>
                <td style="border: 1px solid black;"><small>{{$course->name}}</small></td>
                <td style="border: 1px solid black;"><small>{{ucfirst($course->level)}}</small></td>
                <td style="border: 1px solid black;"><small>{{$course->credit}}</small></td>
                <td style="border: 1px solid black;"><small>{{ucfirst($course->type)}}</small></td>
                <td  style="border: 1px solid black;" class="@if ($course->current_offered == 'Not offered' || $course->current_offered == 'No longer offered') bg-secondary text-white @endif"><small>{{$course->current_offered}}</small></td>
                <td style="border: 1px solid black;"><small>{{$course->next_offered}}</small></td>
                <td style="border: 1px solid black;"><small>{{$course->prerequisite}}</small></td>
                <td style="border: 1px solid black;"><small>{{$course->teacher}}</small></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container"><div class="col-md-12" id="academic-part"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">{{$major->qualification->name.' ('.$major->name.')'}}</h4><table style="text-align:left;border-collapse:collapse;border:1px solid black;"><thead><tr><th style="border: 1px solid black;"><small>@lang('Course Code')</small></th><th style="border: 1px solid black;"><small>@lang('Course Name')</small></th><th style="border: 1px solid black;"><small>@lang('Course Level')</small></th><th style="border: 1px solid black;"><small>@lang('Course Type')</small></th><th style="border: 1px solid black;"><small>@lang('Credits')</small></th><th style="border: 1px solid black;"><small>@lang('Current Offered')</small></th><th style="border: 1px solid black;"><small>@lang('Next Offered')</small></th><th style="border: 1px solid black;"><small>@lang('Prerequisites')</small></th><th style="border: 1px solid black;"><small>@lang('Tutor')</small></th></tr></thead><tbody>@foreach ($major->courses as $course)<tr><td style="border: 1px solid black;"><small>{{$course->code}}</small></td><td style="border: 1px solid black;"><small>{{$course->name}}</small></td><td style="border: 1px solid black;"><small>{{ucfirst($course->level)}}</small></td><td style="border: 1px solid black;"><small>{{$course->credit}}</small></td><td style="border: 1px solid black;"><small>{{ucfirst($course->type)}}</small></td><td  style="border: 1px solid black;" class="@if ($course->current_offered == 'Not offered' || $course->current_offered == 'No longer offered') bg-secondary text-white @endif"><small>{{$course->current_offered}}</small></td><td style="border: 1px solid black;"><small>{{$course->next_offered}}</small></td><td style="border: 1px solid black;"><small>{{$course->prerequisite}}</small></td><td style="border: 1px solid black;"><small>{{$course->teacher}}</small></td></tr>@endforeach</tbody></table></div></div>

<!------------Tutors----------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="container">
    <div class="col-md-12" id="academic-part">
        <h2 style="text-align:center;">{{Auth::user()->school->name}}</h2>
        <h4 style="text-align:center;">@lang('Tutors')</h4>
        <table style="text-align:left;border-collapse:collapse;border:1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">@lang('Full Name')</th>
                <th style="border: 1px solid black;">@lang('Gender')</th>
                @if (\Auth::user()->role != 'student')
                <th style="border: 1px solid black;">@lang('Code')</th>
                @endif
                <th style="border: 1px solid black;">@lang('Department')</th>
                @if (\Auth::user()->role != 'student')
                <th style="border: 1px solid black;">@lang('Phone')</th>
                @endif
                <th style="border: 1px solid black;">@lang('Email')</th>
                @if (\Auth::user()->role != 'student')
                <th style="border: 1px solid black;">@lang('Enrolled Date')</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td style="border: 1px solid black;">{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</td>
                <td style="border: 1px solid black;">{{ucfirst($user->gender)}}</td>
                @if (\Auth::user()->role != 'student')
                <td style="border: 1px solid black;">{{$user->code}}</td>
                @endif
                <td style="border: 1px solid black;">{{ucfirst($user->programme->name)}}</td>
                @if (\Auth::user()->role != 'student')
                <td style="border: 1px solid black;">{{$user->phone_number}}</td>
                @endif
                <td style="border: 1px solid black;">{{$user->email}}</td>
                @if (\Auth::user()->role != 'student')
                <td style="border: 1px solid black;">{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container"><div class="col-md-12" id="academic-part"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">@lang('Tutors')</h4><table style="text-align:left;border-collapse:collapse;border:1px solid black;"><thead><tr><th style="border: 1px solid black;">@lang('Full Name')</th><th style="border: 1px solid black;">@lang('Gender')</th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;">@lang('Code')</th>@endif<th style="border: 1px solid black;">@lang('Department')</th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;">@lang('Phone')</th>@endif<th style="border: 1px solid black;">@lang('Email')</th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;">@lang('Enrolled Date')</th>@endif</tr></thead><tbody>@foreach ($users as $user)<tr><td style="border: 1px solid black;">{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</td><td style="border: 1px solid black;">{{ucfirst($user->gender)}}</td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;">{{$user->code}}</td>@endif<td style="border: 1px solid black;">{{ucfirst($user->programme->name)}}</td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;">{{$user->phone_number}}</td>@endif<td style="border: 1px solid black;">{{$user->email}}</td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;">{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</td>@endif</tr>@endforeach</tbody></table></div></div>

<!-----------Students------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="container">
    <div class="col-md-12" id="academic-part">
        <h2 style="text-align:center;">{{Auth::user()->school->name}}</h2>
        <h4 style="text-align:center;">@lang('Students')</h4>
        <table style="text-align:left;border-collapse:collapse;border:1px solid black;">
            <thead>
                <tr>
                    <th style="border: 1px solid black;"><small>@lang('Full Name')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Gender')</small></th>
                    @if (\Auth::user()->role != 'student')
                    <th style="border: 1px solid black;"><small>@lang('Code')</small></th>
                    @endif
                    <th style="border: 1px solid black;"><small>@lang('Programme')</small></th>
                    @if (\Auth::user()->role != 'student')
                    <th style="border: 1px solid black;"><small>@lang('Qualification')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Major')</small></th>
                    <th style="border: 1px solid black;"><small>@lang('Phone')</small></th>
                    @endif
                    <th style="border: 1px solid black;"><small>@lang('Email')</small></th>
                    @if (\Auth::user()->role != 'student')
                    <th style="border: 1px solid black;"><small>@lang('Enrolled Date')</small></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td style="border: 1px solid black;"><small>{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</small></td>
                    <td style="border: 1px solid black;"><small>{{ucfirst($user->gender)}}</small></td>
                    @if (\Auth::user()->role != 'student')
                    <td style="border: 1px solid black;"><small>{{$user->code}}</small></td>
                    @endif
                    <td style="border: 1px solid black;"><small>{{ucfirst($user->programme->name)}}</small></td>
                    @if (\Auth::user()->role != 'student')
                    <td style="border: 1px solid black;"><small>{{ucfirst($user->qualification->name)}}</small></td>
                    <td style="border: 1px solid black;"><small>{{ucfirst($user->major->name)}}</small></td>
                    <td style="border: 1px solid black;"><small>{{$user->phone_number}}</small></td>
                    @endif
                    <td style="border: 1px solid black;"><small>{{$user->email}}</small></td>
                    @if (\Auth::user()->role != 'student')
                    <td style="border: 1px solid black;"><small>{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</small></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container"><div class="col-md-12" id="academic-part"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">@lang('Students')</h4><table style="text-align:left;border-collapse:collapse;border:1px solid black;"><thead><tr><th style="border: 1px solid black;"><small>@lang('Full Name')</small></th><th style="border: 1px solid black;"><small>@lang('Gender')</small></th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;"><small>@lang('Code')</small></th>@endif<th style="border: 1px solid black;"><small>@lang('Programme')</small></th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;"><small>@lang('Qualification')</small></th><th style="border: 1px solid black;"><small>@lang('Major')</small></th><th style="border: 1px solid black;"><small>@lang('Phone')</small></th>@endif<th style="border: 1px solid black;"><small>@lang('Email')</small></th>@if (\Auth::user()->role != 'student')<th style="border: 1px solid black;"><small>@lang('Enrolled Date')</small></th>@endif</tr></thead><tbody>@foreach ($users as $user)<tr><td style="border: 1px solid black;"><small>{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</small></td><td style="border: 1px solid black;"><small>{{ucfirst($user->gender)}}</small></td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;"><small>{{$user->code}}</small></td>@endif<td style="border: 1px solid black;"><small>{{ucfirst($user->programme->name)}}</small></td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;"><small>{{ucfirst($user->qualification->name)}}</small></td><td style="border: 1px solid black;"><small>{{ucfirst($user->major->name)}}</small></td><td style="border: 1px solid black;"><small>{{$user->phone_number}}</small></td>@endif<td style="border: 1px solid black;"><small>{{$user->email}}</small></td>@if (\Auth::user()->role != 'student')<td style="border: 1px solid black;"><small>{{Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y')}}</small></td>@endif</tr>@endforeach</tbody></table></div>

<!-----------Tutor's Courses------------------------------------------------------------------------------------------------------------------------------------------------------>


