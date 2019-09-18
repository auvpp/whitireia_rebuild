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
                    @if (\Auth::user()->course_token == 1 && \Auth::user()->school->toggle == 1)
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
                        @component('components.general-courses-list', ['courses'=>$courses, 'user'=>$user])
                        @endcomponent    
                    @else
                    <div class="card text-white bg-danger col-sm-8">
                        <div class="card-header">@lang('Notice')</div>
                        <div class="card-body">
                            @lang('The current course selection system has been closed or you have already selected the class.')
                            <br>
                            @lang('If you want to make changes, please contact the administrator.')
                            <br>
                        </div>
                    </div>
                    <br>
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
