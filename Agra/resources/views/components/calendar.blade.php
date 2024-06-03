<!-- resources/views/components/calendar.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Calendar Component' }}</title>
</head>
<body>
    <x-partials.calendar :tasks="$tasks" />
    <div>
        {{ $slot ?? '' }}
    </div>
    {{ $scripts ?? '' }}
</body>
</html>
