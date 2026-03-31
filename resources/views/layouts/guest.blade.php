<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: "Fredoka", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background:
              radial-gradient(1200px 600px at 20% 10%, #fffbe0 0%, transparent 55%),
              radial-gradient(900px 500px at 80% 20%, #fff2a8 0%, transparent 60%),
              linear-gradient(180deg, #FFF6B3, #fff 60%);
            min-height:100vh;
        }
        .card{
            background:rgba(255,255,255,.75);
            border:1px solid rgba(0,0,0,.06);
            border-radius:22px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <a href="{{ route('landing') }}" class="mb-6 font-bold text-lg">
            📚 Perpustakaan Digital
        </a>

        <div class="w-full sm:max-w-md p-6 card">
            {{ $slot }}
        </div>

        <div class="mt-6 text-sm opacity-75">
            Login & Register khusus <b>User</b>
        </div>
    </div>
</body>
</html>
