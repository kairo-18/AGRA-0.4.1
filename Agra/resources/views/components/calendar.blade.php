<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'sidebarSample'}}</title>
</head>
<body>
    
<x-partials.calendar/>
<div>
    {{ $slot ?? '' }}
</div>


{{ $scripts ?? '' }}
</body>
</html>