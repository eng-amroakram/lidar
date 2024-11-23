<?php

namespace App\Livewire\Admin\Auth;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;

    public $email_phone = '';
    public $password = '';
    public $otp_check = false;
    public $otp_code = '';

    public $remainingTime; // Time remaining in seconds
    public $canResend = false;

    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->otp_check = $user->email_verified_at ? false : true;

            // Check if there's already an expiration time in the session
            $expirationTime = Session::get('otp_code.expires_at');

            if ($expirationTime && now()->lessThan($expirationTime)) {
                $this->remainingTime = now()->diffInSeconds($expirationTime);
            } else {
                $this->remainingTime = 0;
                $this->canResend = true;
            }
        }
    }

    #[Layout('layouts.admin.login', ['headerTitle' => 'Log In to Your Account']), Title('Control Panel - Login')]
    public function render()
    {
        return view('livewire.admin.auth.login');
    }

    #[On('submitting-login-data')]
    public function submit()
    {
        $user = User::where('email', $this->email_phone)->orWhere('phone', $this->email_phone)->first();

        if ($user) {
            if (Hash::check($this->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('frontend.home');
            }

            $this->dispatch('admin-db-login-validation', ["password" => "Check the password"]);
            return "";
        }

        $this->dispatch('admin-db-login-validation', ["email" => "Check the email or phone number"]);
        return "";
    }

    #[On('submitting-otp-code-data')]
    public function verify()
    {
        $user = User::where('id', auth()->id())->first();

        $data = [
            'otp_code' => $this->otp_code,
        ];

        $rules = [
            'otp_code' => ['required',]
        ];

        $messages = [
            'otp_code.required' => 'OTP Code is required',
        ];

        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('otp-code-validation', $errors);
            $this->alertMessage('Please check the data', 'error');
            return false;
        }

        // if ($user->otp_code == $data['otp_code']) {
        if (session()->get('otp_code.otp_code') == $data['otp_code']) {

            session()->forget('otp_code');

            $result = $user->update([
                // 'otp_code' => null,
                'email_verified_at' => now()
            ]);

            if ($result) {
                return redirect()->route('frontend.home');
            }

            dd("Null");
        } else {
            $this->alertMessage('Your OTP Code in not Correct !', 'error');
        }
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'top-start',
            'timer' => 3000,
            'text' => $message,
            'timerProgressBar' => true,
        ]);
    }

    public function resendOtp()
    {
        if (!$this->canResend) {
            return;
        }

        $user = User::where('email', $this->email_phone)->orWhere('phone', $this->email_phone)->first();
        $user = auth()->user();

        if ($user) {

            $otpCode = rand(100000, 999999); // Generate a random OTP
            $expirationTime = now()->addMinutes(5); // Set expiration time

            // Store OTP and expiration time in the session
            Session::put('otp_code', [
                'otp_code' => $otpCode,
                'expires_at' => $expirationTime
            ]);

            // Reset timer
            $this->remainingTime = now()->diffInSeconds($expirationTime);
            $this->canResend = false;
            Mail::to($user->email)->send(new OtpMail($otpCode, "Registration", $user->name));
            session()->flash('message', 'A new OTP has been sent to your email!');
            $this->alertMessage('A new OTP has been sent to your email!', 'success');
        } else {
            $this->alertMessage("Error !", 'error');
        }
    }

    public function updatedRemainingTime()
    {
        if ($this->remainingTime <= 0) {
            $this->remainingTime = 0;
            $this->canResend = true;
        }
    }

    public function decrementTimer()
    {
        if ($this->remainingTime > 0) {
            $this->remainingTime--;
        } else {
            $this->canResend = true; // Timer expired, allow resend
            Session::put('otp_code', [
                'otp_code' => null,
                'expires_at' => now()->addMinutes(0)
            ]);
        }
    }
}
