<?php

namespace App\Livewire\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->otp_check = $user->email_verified_at ? false : true;
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
            'otp_code' => ['required', 'exists:users,otp_code']
        ];

        $messages = [
            'otp_code.required' => 'OTP Code is required',
            'otp_code.exists' => 'OTP Code is not correct',
        ];

        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->dispatch('otp-code-validation', $errors);
            $this->alertMessage('Please check the data', 'error');
            return false;
        }

        if ($user->otp_code == $data['otp_code']) {

            $result = $user->update([
                'otp_code' => null,
                'email_verified_at' => now()
            ]);

            if ($result) {
                return redirect()->route('frontend.home');
            }

            dd("Null");
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
}
