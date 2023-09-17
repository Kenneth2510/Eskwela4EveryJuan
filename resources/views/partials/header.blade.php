<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">

    <title>{{ $title !== "" ? $title : 'Eskwela4EveryJuan'}}</title>

    
    <script src="https://kit.fontawesome.com/fd323b0f11.js" crossorigin="anonymous"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-full bg-mainwhitebg font-poppins">