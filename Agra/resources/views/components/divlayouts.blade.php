<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'divlayoutsSample'}}</title>
</head>
<body>

<x-partials.divlayouts/>


        {{ $slot ?? '' }}
    </div>
</div>


{{ $scripts ?? '' }}
</body>
</html>
