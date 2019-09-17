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
                            @component('components.mycourses-student-list',['user'=>$user, 'classdetails'=>$classdetails, 'totalCredits'=>$totalCredits])
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
                        <div class="col-sm-7">
                            <button class="btn btn-xs btn-success pull-right" id="btnPrint"><i class="material-icons">print</i> @lang('Print Form')</button>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-xs btn-default"><i class="material-icons">get_app</i> Excel</button>
                        </div>
                    </div> 
                </div>    
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection