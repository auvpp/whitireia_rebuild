@extends('layouts.app')

@section('title', __('Impersonate'))

@section('content')
<div class="container">
    <div class="panel panel-default">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr class="bg-primary text-white">
                    <th>@lang('Action')</th>
                    <th>@lang('ID')</th>
                    <th>@lang('First Name')</th>
                    <th>@lang('Last Name')</th>
                    <th>@lang('Role')</th>
                    <th>@lang('Gender')</th>
                    <th>@lang('Programme')</th>
                    <th>@lang('Qualification')</th>
                    <th>@lang('Major')</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($other_users as $other_user)
                <form method="POST" action="{{ url('/user/config/impersonate') }}">
                    {{ csrf_field() }}
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="{{$other_user->id}}" />
                            <button class="btn btn-default btn-xs">@lang('Impersonate')</button>
                        </td>
                        <td><small>{{ $other_user->id }}</small></td>
                        <td><small>{{ $other_user->first_name }}</small></td>
                        <td><small>{{ $other_user->last_name }}</small></td>
                        <td><small>{{ $other_user->role }}</small></td>
                        <td><small>{{ $other_user->gender }}</small></td>
                        <td><small>
                            @if ($other_user->programme != null)
                                {{$other_user->programme->name}}
                            @endif
                        </small></td>
                        <td><small>
                            @if ($other_user->qualification != null)
                                {{$other_user->qualification->name}}
                            @endif
                        </small></td>
                        <td><small>
                            @if ($other_user->major != null)
                                {{$other_user->major->name}}
                            @endif
                        </small></td>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
