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
                    <div class="page-panel-title"><h3>@lang('Arrange Courses')</h3></div>
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

                        @component('components.arrange-courses', ['teachers'=>$teacher])
                        @endcomponent

                        <a href="{{url()->previous()}}" class="btn btn-xs btn-warning"><i class="material-icons">keyboard_return</i> @lang('Go Back')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function(){

		});	
	</script>
@endsection
