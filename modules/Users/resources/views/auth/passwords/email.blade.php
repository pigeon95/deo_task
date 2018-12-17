@extends('theme::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('partial.auth_forms.email', compact('errors'))
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
