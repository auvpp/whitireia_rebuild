@extends('layouts.app')

@section('title', __('Teachers'))

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
                <div class="page-panel-title"><h3>@lang('List of all') {{ucfirst($user->role)}}s</h3></div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    <!-- @component('components.users-export',['type'=>'teacher'])    
                    @endcomponent -->

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.users-teachers-list',['users'=>$users, 'programmes'=>$programmes])
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
