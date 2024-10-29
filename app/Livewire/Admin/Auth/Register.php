<?php

namespace App\Livewire\Admin\Auth;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    use LivewireAlert;

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $email_confirmation = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';

    #[Layout('layouts.admin.login', ['headerTitle' => 'Register new account']), Title('Control Panel - Register')]
    public function render()
    {
        return view('livewire.admin.auth.register');
    }

    #[On('submitting-registration-data')]
    public function submit()
    {
        $data = [
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "email_confirmation" => $this->email_confirmation,
            "phone" => $this->phone,
            "password" => $this->password,
            "password_confirmation" => $this->password_confirmation,
        ];

        $rules = [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email', 'confirmed'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/'
            ],
        ];

        $messages = [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number is already registered.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'email.confirmed' => 'Email confirmation does not match.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must include at least one uppercase and lowercase letter and number.',
        ];

        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('admin-register-db-validation', $errors);
            $this->alertMessage('Please check the data', 'error');
            return false;
        }

        $otp = rand(100000, 999999); // Generate a random OTP

        // Create a new user and hash the password
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'otp_code' => $otp,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp, "Registration", $user->name));

        // Redirect to the index route
        return redirect()->route('frontend.index')->with('success', 'Registration successful!');
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
