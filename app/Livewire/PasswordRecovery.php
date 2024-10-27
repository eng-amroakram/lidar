<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PasswordRecovery extends Component
{
    public $email_phone;
    public $user;
    public $message = "";
    public $otp;
    public $password = "";
    public $password_confirmation = "";

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

    public function forget_password()
    {
        $data = $this->validate([
            'password' => [
                'required',
                'string',
                'min:8', // Minimum 8 characters
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/' // At least one uppercase, one lowercase, and one digit
            ],
        ], [
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);

        // Find the user by email or phone
        $user = User::where('email', $this->email_phone)
            ->orWhere('phone', $this->email_phone)
            ->first();

        // Check if the user exists
        if (!$user) {
            return back()->with('error', 'Data Error !!');
        }

        // Update the user's password
        $user->password = Hash::make($data['password']); // Hash the new password
        $user->save(); // Save the changes

        // Optionally, you can flash a success message
        return redirect()->route('frontend.index')->with('success', 'Your password has been updated successfully.');
    }
}
