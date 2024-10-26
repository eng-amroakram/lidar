<div class="right-side">
    <div class="login-container">
        <h2 style="text-align: center;">{{ $otp ? 'Verify Your Account' : 'Log in To Your Account' }}</h2>

        {{-- Flash message for registration success --}}
        @if (session('success'))
            <div class="alert" style="display: {{ session('success') ? 'block' : 'none' }};">
                {{ session('success') }}
            </div>
        @endif

        {{-- Flash message for registration success --}}
        @if (session('error'))
            <div class="alert" style="display: {{ session('error') ? 'block' : 'none' }};">
                {{ session('error') }}
            </div>
        @endif

        @if ($otp)
            <form id="OtpForm" action="{{ route('auth.verify_email') }}" method="POST">
                @csrf
                <input type="text" maxlength="6" id="otp" name="otp" placeholder="Enter the OTP code">
                @error('otp')
                    <small style="color: red;">{{ $message }}</small>
                @enderror

                <button type="submit">Verify</button>

                <div class="options">
                    <a href=  "{{ route('auth.register_page') }}">register for free</a> |
                    <a href="{{ route('auth.forget_password_page') }}">forget password?</a>
                </div>
            </form>
        @endif

        @if (!$otp)
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

                <button type="submit">Log in to liguard</button>

                <div class="options">
                    <a href=  "{{ route('auth.register_page') }}">register for free</a> |
                    <a href="{{ route('auth.forget_password_page') }}">forget password?</a>
                </div>

            </form>
        @endif
    </div>
</div>
