<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Check if user is verified
            if (!$user->isVerified()) {
                // Generate and send OTP
                $otp = $user->generateOtp();
                Mail::to($user->email)->send(new OtpMail($otp, $user->name));
                
                return redirect()->route('verify.otp');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return Inertia::render('Auth/Register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        // Generate and send OTP
        $otp = $user->generateOtp();
        Mail::to($user->email)->send(new OtpMail($otp, $user->name));

        Auth::login($user);

        return redirect()->route('verify.otp');
    }

    public function showVerifyOtp()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->isVerified()) {
            return redirect('/');
        }

        $resendStatus = $user->canResendOtp();

        return Inertia::render('Auth/VerifyOtp', [
            'email' => $user->email,
            'canResend' => $resendStatus['can_resend'],
            'waitSeconds' => $resendStatus['wait_seconds'],
            'remainingToday' => $resendStatus['remaining_today'],
            'nextCooldown' => $user->getNextCooldown(),
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->verifyOtp($request->otp)) {
            return redirect()->intended('/')->with('success', 'Email berhasil diverifikasi!');
        }

        return back()->withErrors([
            'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.',
        ]);
    }

    public function resendOtp()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->isVerified()) {
            return redirect('/');
        }

        $resendStatus = $user->canResendOtp();
        
        if (!$resendStatus['can_resend']) {
            return back()->withErrors([
                'resend' => $resendStatus['reason'],
            ]);
        }

        $otp = $user->resendOtp();
        Mail::to($user->email)->send(new OtpMail($otp, $user->name));

        return back()->with([
            'success' => 'Kode OTP baru telah dikirim ke email Anda.',
            'nextCooldown' => $user->getNextCooldown(),
            'remainingToday' => 5 - $user->otp_resend_count,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showProfile()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        return Inertia::render('Profile', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
            ],
        ]);
    }
}
