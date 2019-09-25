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
                <div class="page-panel-title"><h3>@lang('Tutor\'s Courses')</h3></div>
                <div class="panel-body">
                    <div class="row>">
                        <div class="col-sm-8">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            @component('components.mycourses-teacher-selections',['myclasses'=>$myclasses, 'grades'=>$grades, 'mystudents'=>$mystudents])
                            @endcomponent
                        </div>
                        <div class="list-group col-sm-4">
                            <a class="list-group-item active">{{ucfirst($user->first_name).' '.ucfirst($user->last_name.' - '.$user->code)}}</a>
                            <a class="list-group-item text-primary">@lang('Programme : ')<small>{{$user->programme->name}}</small></a>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection