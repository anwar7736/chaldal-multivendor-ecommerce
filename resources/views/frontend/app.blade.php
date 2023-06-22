<!DOCTYPE html>
<html lang="en">
    @include('frontend.partials.head')
<body>
    <div class="loading">Loading&#8230;</div>
    @include('frontend.partials.header')
    @include('frontend.partials.sidebar')
    @yield('content')

    @include('frontend.partials.footer')
    
