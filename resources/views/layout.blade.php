<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('styles/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/background.css') }}">
    <title>Task Management Application</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/task.js') }}"></script>
</head>
<body>
    <div class="container m-auto mt-4 px-4">
        @yield('content')
    </div>
</body>
</html>
