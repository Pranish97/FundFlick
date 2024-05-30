<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Models\User;
use App\Models\Fund;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'country_code' => 'required|string',
            'phone_number' => 'required|string|max:20|unique:users',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'country_code' => $request->country_code,
            'phone_number' => $request->phone_number,
            'user_amount' => 0.00,
            'otp' => $otp,
        ]);

        Fund::create([
            'user_id' => $user->id,
            'amount' => 0.00,
            'amount_updated_time' => now(),
            'updated_user_amount' => 0.00,
        ]);

        $data = [
            'subject' => 'FundFlick - OTP',
            'body' => "<p><strong>Your OTP to register in FundFlick is $otp</strong></p>"
        ];

        Mail::to($request->email)->send(new SendOtpMail($otp, $data));

        return redirect()->route('otp', ['email' => $user->email])->with('success', 'Succes! We have send OTP to your Email address');;
    }

    public function showOTPVerificationForm($emailFromUrl)
    {
        return view('otp', ['emailFromUrl' => $emailFromUrl]);
    }

    public function verifyOtp(Request $request, $email)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->otp == $request->otp) {
                $user->email_verified_at = now();
                $user->otp = null;
                $user->save();

                return redirect('/login')->with('success', 'Email verified successfully. You can now login.');
            }
        } else {
            return back()->with(['otp' => 'User not found or invalid email.']);
        }

        return back()->with(['otp' => 'Invalid OTP. Please try again.']);
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && !is_null(Auth::user()->email_verified_at)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with([
            'error' => 'The provided credentials are incorrect or your email is not verified.',
        ])->withInput($request->only('email'));
    }
}
