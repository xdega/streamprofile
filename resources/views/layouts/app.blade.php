<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>| StreamProfile |</title>

    <!-- Fonts -->
    <link href="/css/out/fonts/fonts.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>

    <!-- Nav Menu -->
    <nav class="nav has-shadow">
        <div class="container">
            <div class="nav-left">
                <a href="/" class="nav-item">
                    <div class="branding">
                        <span class="logo-word1">Stream</span><span class="logo-word2">Profile</span>
                    </div>
                </a>

                <div class="nav-item profile-lookup is-hidden-mobile">
                    <input class="input is-hidden-mobile" type="input" placeholder="Coming Soon">
                    </input>
                </div>
            </div>

            <div class="nav-right">
                @if( !Auth::check() )

                    <a href="/login" class="nav-item">Log In</a>
                    <a href="/register" class="nav-item">Register</a>

                @else

                    <a href="/dashboard" class="nav-item">Dashboard 
                    <span class="is-hidden-mobile">({{ Auth::user()->username }})</span></a>
                    <a href="/logout" class="nav-item">Log Out</a>

                @endif
            </div>

        </div>
    </nav>

    <div id="app" class="container">
        {{ $slot }}
    </div>

    <footer class="footer is-sticky">
        <div class="container">
            <div class="content has-text-centered">
                <p>
                    Made with &hearts; by Liam Hockley. 2017 &copy;
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

</body>
</html>
