@extends('theme::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('partial.auth_forms.login', compact('errors'))
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
