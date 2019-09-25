@extends('layouts.app')

@section('title', __('Business'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <h2>@lang('Business')</h2>
            
            <div class="row">
                @if (count($qualifications) > 0)
                @foreach ($qualifications as $q)
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ ucfirst($q->level) }}</h3>
                        </div>
                        <a href="{{ url('programmes/business/'.$q->id) }}">
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
@endsection
