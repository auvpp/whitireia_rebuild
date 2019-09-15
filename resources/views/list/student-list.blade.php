@extends('layouts.app')

@section('title', __('Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
              @if(count($users) > 0)
              @foreach ($users as $user)
                <!-- @if (Session::has('section-attendance'))
                <ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes &amp; Sections')</a></li>
                    <li class="active">{{ucfirst($user->role)}}s</li>
                </ol>
                @endif -->
                <div class="page-panel-title"><h3>@lang('List of all') {{ucfirst($user->role)}}s</h3></div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @component('components.users-export',['type'=>'student'])
                    @endcomponent

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.users-students-list',['users'=>$users,'current_page'=>$current_page,'per_page'=>$per_page, 'programmes'=>$programmes, 'qualifications'=>$qualifications, 'majors'=>$majors])
                    @endcomponent
                </div>
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
