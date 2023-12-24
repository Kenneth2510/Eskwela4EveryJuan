<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">

    <title>{{ $title !== "" ? $title : 'Eskwela4EveryJuan'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <script src="https://kit.fontawesome.com/fd323b0f11.js" crossorigin="anonymous"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{asset('js/sidebar.js')}}" defer></script>
    <script src="{{ asset('js/script.js')}}" defer></script>
    <script src="{{ asset('js/modal.js')}}" defer></script>

    <script src="https://cdn.tiny.cloud/1/tu1cijjt9ribhv45aa09w924q0rsgb4nrij1ixwt0tnjt0ql/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    
    
    @if (isset($scripts))
        @forelse ($scripts as $script)
            
            <script src="{{asset('js/' .  $script)}}" defer></script>
        @empty
            <script src"" defer></script>
        @endforelse
    @endif
</head>
<body class="min-h-full bg-mainwhitebg font-poppins">
    <x-message />