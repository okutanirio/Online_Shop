<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mypage.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    OnlineShop
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inquiry.inquiry_form') }}">お問い合わせ</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('search') }}">🔍</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.list') }}">🛒</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">👤</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('search') }}">🔍</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('like.list') }}">♡</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.list') }}">🛒</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    👤 <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role == 1)
                                        <a class="dropdown-item" href="{{ route('admin') }}">管理者</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('mypage', ['id' => auth()->user()->id]) }}">マイページ</a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
        <div class="footer">CATEGORY</div>
            <table class="foot_table" width="100%">
                <tr>
                    <th>
                    <a href="{{ route('pierce') }}" class="category">ピアス</a>
                    </th>
                    <th>
                    <a href="{{ route('necklace') }}" class="category">ネックレス</a>
                    </th>
                </tr>
                <tr>
                    <th>
                    <a href="{{ route('ring') }}" class="category">リング</a>
                    </th>
                    <th>
                    <a href="{{ route('bracelet') }}" class="category">ブレスレット</a>
                    </th>
                </tr>
            </table>
            <br><br><div class="copyright">&copy; online shop. All Rights Reserved.</div>
    </div>
</body>
</html>