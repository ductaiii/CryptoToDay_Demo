<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Today App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow p-4 flex justify-between">
        <a href="/" class="font-bold text-xl text-blue-700">Crypto Today</a>
        <div>
            @auth
                <span class="mr-4">Xin chào, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4 text-blue-600 hover:underline">Đăng nhập</a>
                <a href="{{ route('register') }}" class="text-green-600 hover:underline">Đăng ký</a>
            @endauth
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
