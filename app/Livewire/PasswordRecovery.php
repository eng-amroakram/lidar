<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class PasswordRecovery extends Component
{
    public $email_phone;
    public $user;
    public $message = "";
    public $otp;

    public function mount($email_phone)
    {
        $user = User::where('email', $email_phone)->orWhere('phone', $email_phone)->first();
        $this->user = $user;
        $this->email_phone = $email_phone;
    }

    public function render()
    {
        return view('livewire.password-recovery');
    }

    public function verify()
    {
        $data = $this->validate([
            'otp' => ['required', 'exists:users,otp_code']
        ], [
            'otp.exists' => 'OTP is not correct'
        ]);

        $user = User::where('phone', $this->email_phone)->orWhere('email', $this->email_phone)->first();

        if ($data['otp'] && $user) {
            if ($data['otp'] == $user->otp_code) {
                $user->update([
                    'otp_code' => null,
                    'email_verified_at' => now()
                ]);
                // return redirect()->route('auth.password_recovery')->with('success', 'Your email has been verified successfully !!');
            }
        }

        $user = User::where('email', $this->email_phone)->orWhere('phone', $this->email_phone)->first();
        $this->user = $user;
    }
}
