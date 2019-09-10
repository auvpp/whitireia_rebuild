@extends('layouts.app')

@section('title', __('Edit'))

@section('content')
<div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
    <div class="row">
        @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        @endif
        <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 8 }}" id="main-container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="panel panel-default">
                <div class="page-panel-title">
                    @lang('Edit') - 
                    @if($user->role == 'student') Student - 
                    @elseif($user->role == 'teacher') Teacher - 
                    @endif
                    {{$user->code}}
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('edit/user') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="user_role" value="{{$user->role}}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">* @lang('First Name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="first_name" value="{{ ucfirst($user->first_name) }}"
                                    required>

                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">* @lang('Last Name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="last_name" value="{{ ucfirst($user->last_name) }}"
                                    required>

                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">* @lang('E-Mail')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">* @lang('Phone Number')</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                    value="{{ $user->phone_number }}">

                                @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('programme') ? ' has-error' : '' }}">
                            <label for="programme" class="col-md-4 control-label">@lang('Programme')</label>
                            <div class="col-md-6">
                                <select id="programme" class="form-control" name="programme_id">
                                    @if (count($programmes)) > 0)
                                    @foreach ($programmes as $p)
                                    <option value="{{$p->id}}" @if ($p->id == old('programme_id', $user->programme_id))
											selected="selected"
										@endif
										>{{$p->name}}</option>
                                    @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('programme'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('programme') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                            <label for="major" class="col-md-4 control-label">@lang('Major')</label>
                            <div class="col-md-6">
                                <select id="major" class="form-control" name="major_id">
                                    @if (count($majors)) > 0)
                                    @foreach ($majors as $m)
                                    <option value="{{$m->id}}" @if ($p->id == old('major_id', $user->major_id))
											selected="selected"
										@endif
										>{{$m->name}}</option>
                                    @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('major'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('major') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">@lang('Address')</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address"
                                    value="{{ $user->address }}">

                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('enrolled_date') ? ' has-error' : '' }}">
                            <label for="enrolled_date" class="col-md-4 control-label">@lang('Enrolled Date')</label>

                            <div class="col-md-6">
                                <input id="enrolled_date" type="text" class="form-control" name="enrolled_date" required>

                                @if ($errors->has('enrolled_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('enrolled_date') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="about" class="col-md-4 control-label">@lang('About')</label>

                            <div class="col-md-6">
                                <textarea id="about" class="form-control" name="about">{{ $user->about }}</textarea>

                                @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="javascript:history.back()" class="btn btn-danger" style="margin-right: 2%;"
                                    role="button">@lang('Cancel')</a>
                                <input type="submit" role="button" class="btn btn-success" value="@lang('Save')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#enrolled_date').datepicker({
            format: "dd-mm-yyyy",
            // viewMode: "years",
            // minViewMode: "years",
        });
        $('#enrolled_date').datepicker('setDate', "{{ Carbon\Carbon::parse($user->enrolled_date)->format('d-m-Y') }}");
    });
</script>
@endsection