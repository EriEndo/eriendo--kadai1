<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/common.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Noto+Serif+JP:wght@400;600&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    FashionablyLate
                </a>
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            @yield('header-nav__auth-action')
                        </li>
                    </ul>
                </nav>
            </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>