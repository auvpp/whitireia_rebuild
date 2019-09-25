@extends('layouts.app')
@section('title', __('My Courses List'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">
                    <h3>@lang('Selected and Completed Courses')</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-8">
                            @component('components.mycourses-student-selections',['user'=>$user, 'classdetails'=>$classdetails, 'totalCredits'=>$totalCredits])
                            @endcomponent
                        </div>
                        <div class="list-group col-sm-4">
                            <a class="list-group-item active">{{ucfirst($user->first_name).' '.ucfirst($user->last_name.' - '.$user->code)}}</a>
                            <a class="list-group-item text-primary">@lang('Major : ')<small>{{$user->major->name}}</small></a>
                            <a class="list-group-item text-primary">@lang('Qualification : ')<small>{{$user->qualification->name}}</small></a>
                            <a class="list-group-item text-primary">@lang('Programme : ')<small>{{$user->programme->name}}</small></a>
                            <a class="list-group-item text-primary">@lang('Current Credits : ')<small>{{$totalCredits}}</small></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                        @if (\Auth::user()->role == 'admin' || \Auth::user()->role == 'teacher')
                            <a href="{{url()->previous()}}" class="btn btn-xs btn-warning"><i class="material-icons">keyboard_return</i> @lang('Go Back')</a>
                        @endif
                        </div>
                    </div> 
                </div>    
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection