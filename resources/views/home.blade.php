@extends('layouts.app')

@section('content')
<style>
    .badge-download {
        background-color: transparent !important;
        color: #464443 !important;
    }
    .list-group-item-text{
      font-size: 12px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default" style="border-top: 0px;">
           <div class="page-panel-title">@lang('Dashboard')</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="panel panel-default" style="background-color: rgba(242,245,245,0.8);">
                                <div class="panel-body">
                                    <h3>@lang('Welcome to') {{Auth::user()->school->name}}</h3>
                                    @lang('Leading and Illuminating')
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('status'))
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @switch(strtolower(Auth::user()->role))
                        @case('master')
                            @lang('Master') - 
                            @break
                        @case('admin')
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">@lang('Your ID') - <b>{{Auth::user()->code}}</b></div>                        
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-header">@lang('Tutors Number') - <b>{{$totalTeachers}}</b></div>                        
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="card text-white bg-dark mb-3">
                                    <div class="card-header">@lang('Students Number') - <b>{{$totalStudents}}</b></div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-header">@lang('Courses Number') - <b>{{$totalCourses}}</b></div>
                                </div>
                            </div>
                        </div>
                            @break
                        @case('teacher')
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card text-white bg-primary mb-3">
                                        <div class="card-header">@lang('Your ID') - <b>{{Auth::user()->code}}</b></div>                        
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="card text-white bg-success mb-5">
                                        <div class="card-header">@lang('Programme') - <b>{{$current_user->programme->name}}</b></div>
                                    </div>
                                </div>
                            </div>
                            @break
                        @default
                            <div class="row">
                                <div class="col-sm-8">
                                <table class="table table-bordered table-striped table-hover table-condensed">
                                    <tr>
                                        <th>@lang('Your ID')</th>
                                        <td>{{Auth::user()->code}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Major')</th>
                                        <td>{{$current_user->major->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Qualification')</th>
                                        <td>{{$current_user->qualification->name}} ({{$current_user->qualification->credit}} @lang('Credits'))</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Programme')</th>
                                        <td>{{$current_user->programme->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('Current Credits')</th>
                                        <td>{{$totalCredits}} @lang(' Credits')</td>
                                    </tr>
                                </table>
                                </div>                         
                            </div>
                    @endswitch
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
