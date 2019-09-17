@extends('layouts.app')
@section('title', __('Course Selection'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">
                    <h3>@lang('All Available Courses for Student ')
                        <span class="text-danger">{{$user->code}}</span> @lang(' Majored in ') {{$user->major->name}}
                        <h4>{{$user->qualification->name}} @lang(' of ') {{$user->programme->name}} 
                            (@lang('Must Achieve ')
                            <span class="text-danger">
                                @if (Illuminate\Support\Str::contains($user->qualification->name, 'Bachelor'))
                                    @lang('360')
                                @elseif (Illuminate\Support\Str::contains($user->qualification->name, 'Diploma'))
                                    @lang('120')
                                @elseif (Illuminate\Support\Str::contains($user->qualification->name, 'Master'))
                                    @lang('180')
                                @endif
                                @lang('Credits')
                            </span>
                            @lang('to Graduate'))
                        </h4>
                    </h3>
                </div>

                <div class="panel-body">
                    @if (\Auth::user()->active == 0)
                    <div class="card text-white bg-danger col-sm-8">
                        <div class="card-header">@lang('Notice')</div>
                        <div class="card-body">
                            @lang('You have confirmed the courses selection.')
                            <br>
                            @lang('If you want to make changes, please contact the administrator.')
                            <br>
                        </div>
                    </div>
                    <br>
                    @else
                    <div class="card text-white bg-info">
                        <div class="card-header">@lang('Kindly Reminder')</div>
                        <div class="card-body">
                            @lang('According to the requirements of Immigration New Zealand, each international student must select ')
                            <span class="text-warning">@lang('NO LESS THAN 2 COURSES ')(@lang('or 30 credits'))</span>
                            @lang(' per semester.')
                            <br>
                            @lang('But at the same time, we do not recommend that you choose more than 4 courses.')
                            <br>
                            @lang('Once you have confirmed your course selection, you can ')
                            <span class="text-warning">@lang('ONLY')</span>
                            @lang('contact the administrator to make changes within the specified time.')
                        </div>
                    </div>
                    <br>
                    <!-- Courses List for Bachelor in IT -->
                    @if ($user->qualification->name == 'Bachelor of Information Technology')
                        @component('components.itBachelor-courses-list',['courses'=>$courses])
                        @endcomponent
                    <!-- Courses List for GD in IT -->
                    @elseif ($user->qualification->name == 'Graduate Diploma in Information Technology')
                        @component('components.itGD-courses-list',['courses'=>$courses])
                        @endcomponent
                    <!-- Courses List for PGD in IT -->
                    @elseif ($user->qualification->name == 'Postgraduate Diploma in Information Technology')
                        @component('components.itPGD-courses-list',['courses'=>$courses])
                        @endcomponent
                    <!-- Courses List for Master in IT -->
                    @elseif ($user->qualification->name == 'Master of Information Technology')
                        @component('components.itMaster-courses-list',['courses'=>$courses])
                        @endcomponent
                    <!-- Courses List for Master in Business -->
                    @elseif ($user->qualification->name == 'Master of Management')
                        @component('components.busMaster-courses-list',['courses'=>$courses])
                        @endcomponent
                    <!-- other Courses (Bachelor / GD / PGD in Business)-->
                    @else
                        @component('components.general-courses-list',['courses'=>$courses])
                        @endcomponent
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
@endsection
