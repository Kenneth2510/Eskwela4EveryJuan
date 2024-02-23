<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.header')
</head>
<body class="min-h-full bg-mainwhitebg font-poppins">
    <x-message />
    <section class="flex flex-row w-full h-auto bg-mainwhitebg">
        @include('partials.instructorNav')
        @include('partials.instructorSidebar')
        
        @yield('content')
    
        @include('partials.instructorProfile')  
    </section>


@include('partials.footer')