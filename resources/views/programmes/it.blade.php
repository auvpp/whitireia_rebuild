@extends('layouts.app')

@section('title', __('Information Technology'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
            
            @endif
            <h2>@lang('Information Technology')</h2>
            <div class="row">

                @if (count($qualifications) > 0)
                @foreach ($qualifications as $q)
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ ucfirst($q->level) }}</h3>
                        </div>
                        <a href="{{ url('programmes/it/'.$q->id) }}">
                            <div class="panel-body">
                                <h4><b>{{ $q->name }}</b></h4>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
