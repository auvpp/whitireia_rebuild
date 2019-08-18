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
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 7</h3>
                        </div>
                        <a href="#">
                            <div class="panel-body">
                                <h4><b>Bachelor of IT</b></h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 7</h3>
                        </div>
                        <a href="#">
                            <div class="panel-body">
                            <h4><b>Graduate Diploma in IT</b></h4>  
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 8</h3>
                        </div>
                        <a href="#">
                            <div class="panel-body">
                                <h4><b>Postgraduate Diploma in IT</b></h4>   
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 9</h3>
                        </div>
                        <a href="#">
                        <div class="panel-body">
                            <h4><b>Master of IT</b></h4> 
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
