<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\VerificationCodeMail; // We'll create this

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'verification_code' => ['required', 'digits:6'],
        ]);

        // Verify the verification code
        $cachedCode = Cache::get('verification_code_' . $request->email);
        if (!$cachedCode || $cachedCode !== $request->verification_code) {
            return back()->withErrors(['verification_code' => 'Invalid verification code.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Clear the verification code from cache
        Cache::forget('verification_code_' . $request->email);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Send verification code to the provided email.
     */
    public function sendVerificationCode(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = $request->email;
        $code = (string) random_int(100000, 999999);

        // Store the code in cache for 10 minutes
        Cache::put('verification_code_' . $email, $code, now()->addMinutes(10));

        try {
            // Send the code using a Mailable class
            Mail::to($email)->send(new VerificationCodeMail($code));
            
            return response()->json(['message' => 'Verification code sent successfully.']);
        } catch (\Exception $e) {
            \Log::error('Failed to send verification code: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to send verification code. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}