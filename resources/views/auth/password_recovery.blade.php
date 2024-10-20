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
                {{-- Flash message error --}}
                @if (session('error'))
                    <div class="alert" style="display: {{ session('error') ? 'block' : 'none' }};">
                        {{ session('error') }}
                    </div>
                @endif

                @error('email_phone')
                    <div class="alert" style="display: {{ session('error') ? 'block' : 'none' }};">
                        {{ session('error') }}
                    </div>
                @enderror


                <form id="recovery-form" action="{{ route('auth.forget_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email_phone" value="{{ $email_phone }}" />
                    <input type="password" id="password" name="password" placeholder="New Password">
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror

                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="New Password Confirmation">
                    @error('password_confirmation')
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

    <script src="{{ asset('assets/js/password_recovery.js') }}"></script>
</body>

</html>
