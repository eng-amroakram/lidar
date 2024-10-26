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

    @if ($user->otp_code)
        <input type="hidden" name="email_phone" value="{{ $email_phone }}" />
        <input type="text" maxlength="6" id="otp" wire:model="otp" placeholder="Enter OTP Code">
        @error('otp')
            <small>{{ $message }}</small>
        @enderror


        <button wire:click="verify()">Verify</button>
    @endif

    @if (!$user->otp_code)
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
    @endif



    <div class="links">
        <a href="{{ route('auth.register_page') }}">Register free</a>
        <a href="{{ route('frontend.home') }}">Log In</a>
    </div>
</div>
