@extends('layouts.app')

@section('title', __('Majors'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
            
            @endif
            <h2>@lang('Business')</h2>
            
            <div class="row">
                @if (count($majors) > 0)
                @foreach ($majors as $m)
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $m->name }}</h3>
                        </div>
                        <a href="{{ url('programmes/'.$m->qualification->programme->name) }}">
                            <div class="panel-body">
                                <h4><b>{{ $m->name }}</b></h4>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
    </div>
</div>
@endsection
