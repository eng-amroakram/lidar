<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LiGAURD Registration Page</title>

    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">

</head>

<body>
    <header>
        <div class="logo">
            <h1 style="font-size: 16px;">LiGAURD</h1>
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
                    <p class="welcome">Welcome to LiGAURD</p>
                </div>
            </div>
            <div class="right-side">
                <div class="registration-container">
                    <h2 style="text-align: center">Registration</h2>
                    <h3 style="text-align: center">Welcome to liguard</h3>
                    <form id="registrationForm" action="{{ route('auth.register_user') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="input-wrapper">
                                <input type="text" id="firstName" value="{{ old('first_name') }}" name="first_name"
                                    placeholder="First name" maxlength="255" />
                                @error('first_name')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="input-wrapper">
                                <input type="text" id="lastName" value="{{ old('last_name') }}" name="last_name"
                                    placeholder="Last name" maxlength="255" />
                                @error('last_name')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-wrapper">
                                <input type="email" id="email" value="{{ old('email') }}" name="email"
                                    placeholder="Email" />
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <input type="email" id="confirmEmail" value="{{ old('email_confirmation') }}"
                                    name="email_confirmation" placeholder="Confirm email" />
                                @error('email_confirmation')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-wrapper-full">
                                <input type="tel" id="phone" value="{{ old('phone') }}" name="phone"
                                    placeholder="Phone number" />
                                @error('phone')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-wrapper">
                                <input type="password" id="password" name="password" placeholder="Password" />
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Password Confirmation" />
                                @error('password_confirmation')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="links">
                            <a href="{{ route('frontend.home') }}">Log In</a>
                        </div>
                        <button type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/register.js') }}"></script>

</body>

</html>
