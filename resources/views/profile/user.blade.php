@extends('layouts.app')

@if(count(array($user)) > 0)
  @section('title', ucfirst($user->first_name).' '.ucfirst($user->last_name))
@endif

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <h3>@lang('Profile')</h3>
            <div class="panel panel-default">
              <div class="panel-body">
                  @if (session('status'))
                      <div class="col-sm-8 alert alert-success">
                          {{ session('status') }}
                      </div>
                  @else
                    @if(count(array($user)) > 0)
                      @component('components.user-profile',['user'=>$user])
                      @endcomponent
                    @else
                      <div class="col-sm-8 alert alert-warning">
                        @lang('No Related Data Found.')
                      </div>
                    @endif
                  @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
