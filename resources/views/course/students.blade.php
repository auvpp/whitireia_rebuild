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
                    <div class="card text-white bg-info">
                        <div class="card-header">@lang('Kindly Reminder')</div>
                        <div class="card-body">
                            @lang('According to the requirements of Immigration New Zealand, each international student must select ')
                            <span class="text-warning">@lang('NO LESS THAN 2 COURSES')</span>
                            @lang(' per trimester.')
                            <br>
                            @lang('But at the same time, we do not recommend that you choose more than 4 courses.')
                            <br>
                            @lang('Once you have confirmed your course selection, you can ')
                            <span class="text-warning">@lang('ONLY')</span>
                            @lang('contact the administrator to make changes within the specified time.')
                        </div>
                    </div>
                    <br>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- Courses List for Bachelor, GD and PGD in Business -->
                    @if ($user->qualification->name == 'Bachelor of Applied Business Management' || 
                         $user->qualification->name == 'Graduate Diploma in Applied Business Studies' || 
                         $user->qualification->name == 'Postgraduate Diploma in Management')
                        @component('components.template-courses-list',['courses'=>$courses, 'myClasses'=>$myClasses])
                        @endcomponent
                    <!-- Courses List for master in Business -->
                    @elseif ($user->qualification->name == 'Master of Management')
                        @component('components.busMaster-courses-list',['courses'=>$courses, 'myClasses'=>$myClasses])
                        @endcomponent
                    <!-- Courses List for bachelor in IT -->
                    @elseif ($user->qualification->name == 'Bachelor of Information Technology')
                        @component('components.itBachelor-courses-list',['courses'=>$courses, 'myClasses'=>$myClasses])
                        @endcomponent
                    <!-- Courses List for GD in IT -->
                    @elseif ($user->qualification->name == 'Graduate Diploma in Information Technology')
                        @component('components.itGD-courses-list',['courses'=>$courses, 'myClasses'=>$myClasses])
                        @endcomponent
                    <!-- Courses List for PGD in IT -->
                    @elseif ($user->qualification->name == 'Postgraduate Diploma in Information Technology')
                        @component('components.itPGD-courses-list',['courses'=>$courses, 'myClasses'=>$myClasses])
                        @endcomponent
                    <!-- Courses List for master in IT -->
                    @elseif ($user->qualification->name == 'Master of Information Technology')
                        @component('components.itMaster-courses-list',['courses'=>$courses, 'myClasses'=>$myClasses])
                        @endcomponent
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
