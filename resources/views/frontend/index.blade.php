<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LiGAURD Login Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    @livewireStyles
</head>

<body>
    <header>
        <div class="logo">
            <h1 style="font-size: 16px">LiGAURD</h1>
        </div>
        <nav>
            <a href="#">about</a>
            <a href="#">support</a>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="left-side">
                <div class="branding">
                    <img class="main-logo" src="{{ asset('assets/img/logo-ligaurd.png') }}" alt="LiGAURD Logo" />
                </div>
            </div>

            @livewire('index')

        </div>
    </main>

    @livewireScripts
    <script src="{{ asset('assets/js/index.js') }}"></script>

</body>

</html>
