<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MyPlanNote') }}</title>
        <link rel="stylesheet" href="/css/myplan.css" >
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        
        <!-- デフォルトのスタイルシート -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <!-- ブルーテーマの追加スタイルシート -->
        <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
            <!-- Page Heading -->
             <header style="background-color:#BAD3FF;">@include('layouts.navigation')</header>
            <!-- Page Content -->
            <main>
             <div class="content">
               @yield('content')
             </div>
            </main>
            <!--Page Footer-->
             <footer style="background-color:#BAD3FF;"><p>©️2023 Sakiko Hanada</p></header>
            <!--Page Footer-->
    </body>
</html>
