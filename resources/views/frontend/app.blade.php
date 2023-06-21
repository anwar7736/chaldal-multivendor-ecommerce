<!DOCTYPE html>
<html lang="en">
    @include('frontend.partials.head')
<body>
    @include('frontend.partials.header')
    @include('frontend.partials.sidebar')
    @yield('content')

    @include('frontend.partials.footer')
    
