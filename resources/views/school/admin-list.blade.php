@extends('layouts.app')

@section('title', __('Admins'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schools.index') }}"><i class="material-icons">gamepad</i> @lang('Manage School')</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10" id="main-container">
						<h2>Admins</h2>

						@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
						@endif
						
            <div class="panel panel-default">
                @if(count($admins) > 0)
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>@lang('Action')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Code')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Phone Number')</th>
                        </tr>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>
                                @if($admin->active == 0)
                                <a href="{{url('master/activate-admin/'.$admin->id)}}" class="btn btn-xs btn-success"
                                    role="button"><i class="material-icons">done</i>@lang('Activate')</a>
                                @else
                                <a href="{{url('master/deactivate-admin/'.$admin->id)}}" class="btn btn-xs btn-danger"
                                    role="button"><i class="material-icons">clear</i>@lang('Deactivate')</a>
                                @endif
                            </td>
                            <td><a href="#" data-toggle="modal" data-target="#editAdminModal{{$admin->id}}">{{ucfirst($admin->first_name).' '.ucfirst($admin->last_name)}}</a></td>
                            <td>{{$admin->code}}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->phone_number}}</td>
                        </tr>

                        <!-- modal of admin's profile -->
                        <div class="modal fade" id="editAdminModal{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="editAdminModal{{$admin->id}}Label">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
																<div class="modal-header" style="background-color: #5cb85c; color:white !important;">
																		<button class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																		</button>
																		<h4 class="modal-title" id="editAdminModal{{$admin->id}}Label">
																				@lang('Edit - ') <span class="text-primary">@lang('Administrator')
																				</span> - {{$admin->code}} &nbsp; &nbsp; &nbsp;
																				<button type="submit" class="btn btn-warning btn-xs" form="formResetAdmin{{$admin->id}}">@lang('Reset Password')</a>
																		</h4>
																		<form id="formResetAdmin{{$admin->id}}" action="{{url('admin/password/reset')}}" method="POST">
																			{{csrf_field()}}
																			<input type="hidden" name="id" value="{{$admin->id}}"/>
																		</form>
																</div>
																<div class="modal-body">
																	<form class="form-horizontal" action="{{url('school/admin-list/store')}}" method="post">
																	{{csrf_field()}}
																	<input type="hidden" name="id" value="{{$admin->id}}">
																	
																	<div class="row" style="margin-bottom:7px;">
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminFName{{$admin->id}}" class="pull-right control-label">@lang('First Name :')</label>
																		</div>
																		<div class="col-sm-4">
																			<input style="width:100%" name="first_name" class="form-control" id="editAdminFName{{$admin->id}}" value="{{$admin->first_name}}" required>
																		</div>
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminCode{{$admin->id}}" class="pull-right control-label">@lang('Code :')</label>
																		</div>
																		<div class="col-sm-4">
																			<input style="width:100%" name="code" class="form-control" id="editAdminCode{{$admin->id}}" value="{{$admin->code}}" required>
																		</div>
																	</div>

																	<div class="row" style="margin-bottom:7px;">
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminLName{{$admin->id}}" class="pull-right control-label">@lang('Last Name :')</label>
																		</div>
																		<div class="col-sm-4">
																			<input style="width:100%" name="last_name" class="form-control" id="editAdminLName{{$admin->id}}" value="{{$admin->last_name}}" required>
																		</div>
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminGender{{$admin->id}}" class="pull-right control-label">@lang('Gender :')</label>
																		</div>
																		<div class="col-sm-4">
																			<select style="width:100%" class="form-control" id="editAdminGender{{$admin->id}}" name="gender" required>
																				<option value="Male">@lang('Male')</option>
																				<option value="Female">@lang('Female')</option>
																			</select>
																		</div>
																	</div>

																	<div class="row" style="margin-bottom:7px;">
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminEmail{{$admin->id}}" class="pull-right control-label">@lang('Email :')</label>
																		</div>
																		<div class="col-sm-4">
																			<input style="width:100%" name="email" class="form-control" id="editAdminEmail{{$admin->id}}" value="{{$admin->email}}" required>
																		</div>
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminProgramme{{$admin->id}}" class="pull-right control-label">@lang('Department :')</label>
																		</div>
																		<div class="col-sm-4">
																			<select style="width:100%" class="form-control" id="editAdminProgramme{{$admin->id}}" name="programme_id" required>
																			@foreach ($programmes as $p)
																				<option value="{{$p->id}}">{{ucfirst($p->name)}}</option>
																			@endforeach
																			</select>
																		</div>
																	</div>

																	<div class="row" style="margin-bottom:7px;">
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminPhoneNumber{{$admin->id}}" class="pull-right control-label">@lang('Phone Number :')</label>
																		</div>
																		<div class="col-sm-4">
																			<input style="width:100%" name="phone_number" class="form-control" id="editAdminPhoneNumber{{$admin->id}}" value="{{$admin->phone_number}}" required>
																		</div>
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminAddress{{$admin->id}}" class="pull-right control-label">@lang('Address :')</label>
																		</div>
																		<div class="col-sm-4">
																			<input style="width:100%" name="address" class="form-control" id="editAdminAddress{{$admin->id}}" value="{{$admin->address}}">
																		</div>
																	</div>

																	<div class="row" style="margin-bottom:7px;">
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminDate{{$admin->id}}" class="pull-right control-label">@lang('Enrolled Date :')</label>
																		</div>
																		<div class="col-sm-4">
																				<input style="width:100%" name="enrolled_date" class="form-control" id="editAdminDate{{$admin->id}}" value="{{$admin->enrolled_date}}" required>
																		</div>
																		<div class="col-sm-2" style="margin-top:10px;">
																			<label for="editAdminAbout{{$admin->id}}" class="pull-right control-label">@lang('About :')</label>
																		</div>
																		<div class="col-sm-4">
																			<textarea style="width:100%" class="form-control" name="about" rows="1" id="editAdminAbout{{$admin->id}}" value="{{$admin->about}}"></textarea>
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
														$("#editAdminGender{{$admin->id}}").val('{{ucfirst($admin->gender)}}');
														$("#editAdminProgramme{{$admin->id}}").val('{{$admin->programme->id}}');

														$("#editAdminDate{{$admin->id}}").val('{{Carbon\Carbon::parse($admin->enrolled_date)->format('d-m-Y')}}');
														$(function () {
															$('#editAdminDate{{$admin->id}}').datepicker({
																	format: "dd-mm-yyyy",
																	// viewMode: "years",
																	// minViewMode: "years",
															});
															$('#editAdminDate{{$admin->id}}').datepicker('setDate', "{{ Carbon\Carbon::parse($admin->enrolled_date)->format('d-m-Y') }}");
														});     
													});
												</script>
				
                        @endforeach
                    </table>
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
