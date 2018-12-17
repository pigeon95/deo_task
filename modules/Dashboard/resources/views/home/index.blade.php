@extends('theme::layouts.app')

@section('header_title')
    <h1>@lang('dashboard::main.welcome')</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('dashboard::main.welcome', ['user'=> $user->email]).
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-4">
                    @include('dashboard::partial.email_form')
                </div>
            </div>
        </div>
    </div>
@endsection