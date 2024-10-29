<?php

namespace App\Livewire\Admin\Auth;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ForgotPassword extends Component
{
    use LivewireAlert;

    public $email_phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $check_otp = false;
    public $check_password = false;
    public $otp_code = '';

    public function mount($email_phone = '')
    {
        $this->email_phone = $email_phone;
        $user = User::where('email', $email_phone)->orWhere('phone', $email_phone)->first();
        if ($user) {
            $this->check_otp = $user->otp_code && $user->email_verified_at && $user->otp_code != 1 ? true : false;
            $this->check_password = $user->otp_code == 1 && $user->email_verified_at ? true : false;
        }
    }

    #[Layout('layouts.admin.login', ['headerTitle' => 'Recovery Your Account']), Title('Control Panel - Recovery Password')]
    public function render()
    {
        return view('livewire.admin.auth.forgot-password');
    }

    #[On('submitting-recovery-password-data')]
    public function recovery_password()
    {
        $data = [
            "email_phone" => $this->email_phone,
        ];

        $validator = Validator::make(
            $data,
            ['email_phone' => ['required', 'string']],
            ['email_phone.required' => 'Please enter your phone number or email.',]
        )
            ->after(function ($validator) use ($data) {
                if (!User::where('email', $data['email_phone'])->exists() && !User::where('phone', $data['email_phone'])->exists()) {
                    $validator->errors()->add('email_phone', 'The provided phone number or email does not exist in our records.');
                }
            });

        $errors = array_map(fn($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('recovery-password-db-validation', $errors);
            $this->alertMessage('Please check the data', 'error');
            return false;
        }

        $otp = rand(100000, 999999); // Generate a random OTP
        $user = User::where('email', $data['email_phone'])->orWhere('phone', $data['email_phone'])->first();

        if ($user) {
            $user->update([
                'otp_code' => $otp
            ]);
            Mail::to($user->email)->send(new OtpMail($otp, "Password Recovery", $user->name));
        }

        return  redirect()->route('auth.forgot_password', ['email_phone' => $data['email_phone']]);
    }

    #[On('submitting-otp-code-data')]
    public function getting_otp_code()
    {
        $data = [
            "otp_code" => $this->otp_code,
        ];

        $validator = Validator::make(
            $data,
            ['otp_code' => ['required', 'string', 'exists:users,otp_code']],
            [
                'otp_code.required' => 'Please enter your OTP Code.',
                'otp_code.exists' => 'Your OTP Code is not Correct',
            ]
        );

        $errors = array_map(fn($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('recovery-password-db-validation', $errors);
            $this->alertMessage('Please check the data', 'error');
            return false;
        }

        $user = User::where('phone', $this->email_phone)->orWhere('email', $this->email_phone)->first();

        if ($data['otp_code'] && $user) {
            if ($data['otp_code'] == $user->otp_code) {
                $user->update([
                    'otp_code' => 1,
                    'email_verified_at' => now()
                ]);
            }
        }

        $this->alertMessage('Process has been done successfully', 'success');
        return  redirect()->route('auth.forgot_password', ['email_phone' => $this->email_phone]);
    }

    #[On('submitting-resetting-password-data')]
    public function resetting_password()
    {
        $data = [
            "password" => $this->password,
            "password_confirmation" => $this->password_confirmation,
        ];

        $validator = Validator::make(
            $data,
            [
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum 8 characters
                    'confirmed',
                    'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/' // At least one uppercase, one lowercase, and one digit
                ],
            ],
            [
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Password confirmation does not match.',
                'password.regex' => 'Password must contain at least one uppercase, lowercase letter and one number.',
            ]
        );

        $errors = array_map(fn($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('recovery-password-db-validation', $errors);
            $this->alertMessage('Please check the data', 'error');
            return false;
        }

        // Find the user by email or phone
        $user = User::where('email', $this->email_phone)
            ->orWhere('phone', $this->email_phone)
            ->first();

        if (!$user) {
            $this->alertMessage('Please check the data', 'error');
        }

        // Update the user's password
        $user->password = Hash::make($data['password']); // Hash the new password
        $user->save(); // Save the changes

        // Optionally, you can flash a success message
        return redirect()->route('frontend.index')->with('success', 'Your password has been updated successfully.');
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
}
