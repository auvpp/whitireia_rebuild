@extends('layouts.app')

@section('title', __('Business'))

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
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 7</h3>
                        </div>
                        <a href="#">
                            <div class="panel-body">
                                <h4><b>Bachelor of Applied Business Management</b></h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 7</h3>
                        </div>
                        <a href="#">
                            <div class="panel-body">
                            <h4><b>Graduate Diploma in Applied Business Studies</b></h4>  
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 8</h3>
                        </div>
                        <a href="#">
                            <div class="panel-body">
                                <h4><b>Postgraduate Diploma in Management</b></h4>   
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">LEVEL 9</h3>
                        </div>
                        <a href="#">
                        <div class="panel-body">
                            <h4><b>Master of Management</b></h4> 
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
