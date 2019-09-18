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
                            </div>
                            <div class="col-sm-5">
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
                            <div class="col-sm-5">
                                @if ($toggle == 0)
                                <small>@lang('Click the "Open Selection" button to activate the course selection system.')</small>
                                @else
                                <small>@lang('Click the "Close Selection" button to deactivate the course selection system.')</small>
                                @endif
                            </div>
                        </div>

                        <br>
                        <br>

                        <h4>@lang('Add Users')</h4>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-primary btn-sm">+ @lang('Add Student')</button>
                            </div>
                            <div class="col-sm-5">
                                <button class="btn btn-info btn-sm">+ @lang('Add Tutor')</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <small>@lang('Or, Mass upload Excel')</small>
                                @component('components.excel-upload-form', ['type'=>'student'])
                                @endcomponent
                            </div> 
                            <div class="col-sm-5">           
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

    <!-- Modal for adding a course -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5cb85c; color:white !important;">          
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="addCourseModalLabel">@lang('Add A New Course')</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{url('add/course/')}}" method="post">
                        {{csrf_field()}}
                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseCode" class="pull-right control-label">@lang('Course Code :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input style="width:100%" type="text" name="code" class="form-control" id="addCourseCode" required>
                            </div>                                  
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseName" class="pull-right control-label">@lang('Course Name :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input style="width:100%" type="text" name="name" class="form-control" id="addCourseName" required>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseLevel" class="pull-right control-label">@lang('Course Level :')</label>
                            </div>
                            <div class="col-sm-8">
                                <select style="width:100%" class="form-control" id="addCourseLevel" name="level" required>
                                <option value="Level 5">@lang('Level 5')</option>
                                <option value="Level 6">@lang('Level 6')</option>
                                <option value="Level 7">@lang('Level 7')</option>
                                <option value="Level 8">@lang('Level 8')</option>
                                <option value="Level 9">@lang('Level 9')</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseType" class="pull-right control-label">@lang('Course Type :')</label>
                            </div>
                            <div class="col-sm-8">
                                <select style="width:100%" class="form-control" id="addCourseType" name="type" required>
                                <option value="Compulsory">@lang('Compulsory')</option>
                                <option value="Elective">@lang('Elective')</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseCredit" class="pull-right control-label">@lang('Credits :')</label>
                            </div>
                            <div class="col-sm-8">
                                <select style="width:100%" class="form-control" id="addCourseCredit" name="credit" required>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                                <option value="60">60</option>
                                <option value="90">90</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCoursePrerequisite" class="pull-right control-label">@lang('Prerequisites :')</label>
                            </div>
                            <div class="col-sm-8">
                                <input style="width:100%" type="text" name="prerequisite" class="form-control" id="addCoursePrerequisite">
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseCurrentOffered" class="pull-right control-label">@lang('Current Offered :')</label>
                            </div>
                            <div class="col-sm-8">
                                <select style="width:100%" class="form-control" id="addCourseCurrentOffered" name="current_offered" required> 
                                <option value="{{'T1-'.date('Y')}}">{{ 'T1-'.date('Y')}}</option>
                                <option value="{{'T2-'.date('Y')}}">{{ 'T2-'.date('Y')}}</option>
                                <option value="{{'T1-'.(date('Y')+1)}}">{{ 'T1-'.(date('Y')+1)}}</option>
                                <option value="{{'T2-'.(date('Y')+1)}}">{{ 'T2-'.(date('Y')+1)}}</option>
                                <option value="Not offered">@lang('Not offered')</option>
                                <option value="TBA">@lang('TBA')</option>
                                <option value="No longer offered">@lang('No longer offered')</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseNextTerm" class="pull-right control-label">@lang('Next Offered :')</label>
                            </div>
                            <div class="col-sm-8">
                                <select style="width:100%" class="form-control" id="addCourseNextOffered" name="next_offered" required>
                                <option value="{{'T1-'.date('Y')}}">{{ 'T1-'.date('Y')}}</option>
                                <option value="{{'T2-'.date('Y')}}">{{ 'T2-'.date('Y')}}</option>
                                <option value="{{'T1-'.(date('Y')+1)}}">{{ 'T1-'.(date('Y')+1)}}</option>
                                <option value="{{'T2-'.(date('Y')+1)}}">{{ 'T2-'.(date('Y')+1)}}</option>
                                <option value="TBA">@lang('TBA')</option>
                                <option value="Not offered">@lang('Not offered')</option>
                                <option value="No longer offered">@lang('No longer offered')</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseTeacher" class="pull-right control-label">@lang('Tutor :')</label>
                            </div>
                            <div class="col-sm-8">
                                <select style="width:100%" class="form-control" id="addCourseTeacher" name="teacher_id" required>
                                <option value="0">@lang('TBA')</option>
                                @foreach ($teachers as $teacher)
                                <option value="{{$teacher->user_id}}">{{ucfirst($teacher->first_name).' '.ucfirst($teacher->last_name).' ('.ucfirst($teacher->programme->name).')'}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-4">
                                <label for="addCourseDescription" class="pull-right control-label">@lang('Description :')</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea style="width:100%" class="form-control" name="description" rows="2" id="addCourseDescription"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-danger btn-sm">@lang('Save')</button>
                        </div>
                    </form>
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
