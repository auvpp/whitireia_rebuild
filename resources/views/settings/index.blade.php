@extends('layouts.app')

@section('title', __('Academic Settings'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title"><h3>@lang('Academic Settings')</h3></div>
                    <div class="panel-body">
                        
                        @if (session('status'))
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <h4>@lang('Manage Courses')</h4>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#addCourseModal">+ @lang('Add Course')</button>
                                @component('components.add-course', ['programmes'=>$programmes, 'qualifications'=>$qualifications, 'majors'=>$majors, 'teachers'=>$teachers])
                                @endcomponent
                            </div>
                            <!-- <div class="col-sm-3">
                                <a href="" type="button" class="btn btn-danger btn-sm">@lang('Arrange Courses')</a>
                            </div> -->
                            <div class="col-sm-6">
                                @if ($toggle == 1)
                                <button class="btn btn-danger btn-sm" id="toggle" value="1">@lang('Close Selection')</button>
                                @else
                                <button class="btn btn-success btn-sm" id="toggle" value="0">@lang('Open Selection')</button>
                                @endif
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm-3">
                                <small>@lang('Or, Mass upload Excel')</small>
                                @component('components.excel-upload-form', ['type'=>'student'])
                                @endcomponent
                            </div>
                            <!-- <div class="col-sm-3"><small>@lang('Arrange courses for teachers.')</small></div> -->
                            <div class="col-sm-6">
                                @if ($toggle == 1)
                                <small>@lang('Click the "Close Selection" button to deactivate the course selection system.')</small>
                                <small>@lang('Teachers can only fill in and modify the grades of the courses during the system shutdown period.')</small>
                                @else
                                <small>@lang('Click the "Open Selection" button to activate the course selection system.')</small>
                                @endif
                            </div>
                        </div>

                        <br>
                        <br>

                        <h4>@lang('Add Users')</h4>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudentModal">+ @lang('Add Student')</button>
                                @component('components.add-student', ['programmes'=>$programmes, 'qualifications'=>$qualifications, 'majors'=>$majors])
                                @endcomponent
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addTeacherModal">+ @lang('Add Tutor')</button>
                                @component('components.add-teacher', ['programmes'=>$programmes])
                                @endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <small>@lang('Or, Mass upload Excel')</small>
                                @component('components.excel-upload-form', ['type'=>'student'])
                                @endcomponent
                            </div> 
                            <div class="col-sm-3">           
                                <small>@lang('Or, Mass upload Excel')</small>
                                @component('components.excel-upload-form', ['type'=>'teacher'])
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function(){
            // toggle of the course selection system
            $("#toggle").click(function() {         
                let toggle =$(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/settings',
                    
                    // if we use ajax in Laravel, this headers must be put in here, and 
                    // put <meta name="csrf-token" content="{{ csrf_token() }}"> in the html head
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: { "toggle" : toggle },
                    success: function(data){
                        if(data.success){
                            location.reload();
                        }
                    }
                });
            });
		});	
	</script>
@endsection
