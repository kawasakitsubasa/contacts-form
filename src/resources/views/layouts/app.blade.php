<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>

    {{-- CSS 読み込み（public/css/style.css） --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/auth.css">
</head>

<body>

    <header class="site-header">
    <div class="header-inner">
        <h1 class="site-logo">FashionablyLate</h1>

        <div class="header-nav">
            @auth
                {{-- ログイン中 → logout --}}
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="header-btn">logout</button>
                </form>
            @endauth

            @guest
                {{-- 未ログイン → login / register --}}
                <a href="/login" class="header-btn">login</a>
                <a href="/register" class="header-btn">register</a>
            @endguest
        </div>
    </div>
</header>

    <main class="main">
        @yield('content')
    </main>

</body>
</html>
