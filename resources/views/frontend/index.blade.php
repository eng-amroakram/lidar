<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LiGAURD Login Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
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
                    <img class="main-logo" src="{{ asset('assets/img/logo.png') }}" alt="LiGAURD Logo" />
                </div>
            </div>
            <div class="right-side">
                <div class="login-container">
                    <h2 style="text-align: center;">Login</h2>

                    {{-- Flash message for registration success --}}
                    @if (session('success'))
                        <div class="alert" style="display: {{ session('success') ? 'block' : 'none' }};">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="loginForm" action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <input type="text" maxlength="255" id="email_phone" value="{{ old('email_phone') }}"
                            name="email_phone" placeholder="Phone Number or Email">
                        @error('email_phone')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror

                        <input type="password" id="password" name="password" placeholder="Password">

                        @error('password')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror

                        <button type="submit">log in to liguard</button>

                        <div class="options">
                            <a href=  "{{ route('auth.register_page') }}">register for free</a> |
                            <a href="{{ route('auth.forget_password_page') }}">forget password?</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/index.js') }}"></script>

</body>

</html>
