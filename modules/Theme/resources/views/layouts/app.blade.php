<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('theme::partials.head')
</head>
<body>
@include('theme::partials.nav')
<div class="container">
    @include('theme::partials.messages')

    @yield('content')
</div>
@include('theme::partials.javascript')
</body>
</html>
