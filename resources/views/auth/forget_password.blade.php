<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="{{ asset('assets/css/password_recovery.css') }}">
</head>

<body>
    <div class="">
        <header>
            <div class="logo">
                <h1 style="font-size: 16px">LiGAURD</h1>
            </div>
            <nav>
                <a href="#">about</a>
                <a href="#">support</a>
            </nav>
        </header>

        <section class="password-recovery-section">
            <div class="form-container">
                <h1>Password Recovery</h1>
                <form id="recovery-form" action="{{ route('auth.password_recovery') }}" method="GET">

                    <input type="text" id="email-phone" name="email_phone" placeholder="Phone Number or Email">
                    @error('email_phone')
                        <small>{{ $message }}</small>
                    @enderror
                    <button type="submit">Recover password</button>
                </form>
                <div class="links">
                    <a href="{{ route('auth.register_page') }}">Register free</a>
                    <a href="{{ route('frontend.home') }}">Log In</a>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('assets/js/forget_password.js') }}"></script>
</body>

</html>
