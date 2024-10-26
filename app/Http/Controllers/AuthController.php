<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register_page()
    {
        return view('auth.register');
    }

    public function forget_password_page()
    {
        return view('auth.forget_password');
    }

    public function password_recovery(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email_phone' => ['required', 'string'],
        ], [
            'email_phone.required' => 'Please enter your phone number or email.',
        ])->after(function ($validator) use ($request) {
            $emailOrPhone = $request->input('email_phone');

            // Check if the email or phone exists in the users table
            if (!User::where('email', $emailOrPhone)->exists() && !User::where('phone', $emailOrPhone)->exists()) {
                $validator->errors()->add('email_phone', 'The provided phone number or email does not exist in our records.');
            }
        });

        if ($data->fails()) {
            return back()->withErrors($data)->withInput();
        }

        $otp = rand(100000, 999999); // Generate a random OTP
        $user = User::where('email', $request->email_phone)->orWhere('phone', $request->email_phone)->first();

        if ($user) {
            $user->update([
                'otp_code' => $otp
            ]);
            Mail::to($user->email)->send(new OtpMail($otp, "Password Recovery", $user->name));
        }

        return view('auth.password_recovery', [
            'email_phone' => $request->email_phone
        ]);
    }

    public function login(Request $request)
    {
        $data = Validator::make($request->all(), [
            'email_phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'email_phone.required' => 'Enter your phone or email please!',
            'password.required' => 'Enter password please!',
        ])->after(function ($validator) use ($request) {
            $emailOrPhone = $request->input('email_phone');

            // Check if the input is an email or a phone number
            if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
                // Check if the email exists
                if (!User::where('email', $emailOrPhone)->exists()) {
                    $validator->errors()->add('email_phone', 'This email is not registered.');
                }
            } else {
                // Check if the phone number exists
                if (!User::where('phone', $emailOrPhone)->exists()) {
                    $validator->errors()->add('email_phone', 'This phone number is not registered.');
                }
            }
        });

        if ($data->fails()) {
            return back()->withErrors($data)->withInput();
        }

        // Determine whether the input is an email or a phone number
        $credentials = [];
        $emailOrPhone = $request->input('email_phone');

        if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
            // If input is an email
            $credentials['email'] = $emailOrPhone;
        } else {
            // If input is a phone number
            $credentials['phone'] = $emailOrPhone;
        }

        // Add the password to the credentials
        $credentials['password'] = $request->input('password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            return redirect()->route('frontend.index');
        } else {
            return back()->withErrors(['password' => 'Invalid credentials, please try again.'])->withInput();
        }
    }

    public function register_user(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'email' => ['required', 'string', 'unique:users,email', 'confirmed'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number is already registered.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'email.confirmed' => 'Email confirmation does not match.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

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

    public function forget_password(Request $request)
    {
        $data = $request->validate([
            'email_phone' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        // Find the user by email or phone
        $user = User::where('email', $data['email_phone'])
            ->orWhere('phone', $data['email_phone'])
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

    public function verify_email(Request $request)
    {
        $user = User::where('id', auth()->id())->first();

        $data = $request->validate(['otp' => ['required',]]);

        if ($data['otp'] && $user) {
            if ($data['otp'] == $user->otp_code) {
                $user->update([
                    'otp_code' => null,
                    'email_verified_at' => now()
                ]);
                return redirect()->route('frontend.index')->with('success', 'Your email has been verified successfully !!');
            }
        }

        return redirect()->back()->with('error', 'error has occurred');
    }

    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('frontend.index'); // Redirect to the login page
    }
}
