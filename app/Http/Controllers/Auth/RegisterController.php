<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeEmail; // Correct casing for consistency

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
          // Check honeypot field
        if (!empty($data['honeypot'])) {
            abort(403, 'Bot detected!');
        }

        // Check timestamp (submission must take at least 3 seconds)
        if (isset($data['timestamp']) && (now()->timestamp - $data['timestamp']) < 3) {
            abort(403, 'Submission too fast!');
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the registration form with referral link handling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $referred_by = null;

        // Check if a referral code is present in the URL
        if ($request->has('ref')) {
            // Find the user who referred using the referral code
            $referred_by = User::where('referral_code', $request->query('ref'))->first();
        }

        // Pass the referred user data to the registration view
        return view('auth.register', ['referred_by' => $referred_by]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Check if the user was referred, otherwise set null for referred_by
        $referred_by = $data['referred_by'] ?? null;

        // Create new user
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'password' => Hash::make($data['password']),
            'kyc_status' => 0, // Default value; adjust as needed
            'card' => 0, // Assuming 'card' is optional; adjust as needed
            'pass' => 0, // Assuming 'card' is optional; adjust as needed
        ]);

        // Prepare the email content
        $wMessage = "
            <p>Hello {$user->name},</p>
            <p>We are so happy to have you on board.</p>
            <p>Your email: <strong>{$user->email}</strong></p>
            <p>Your password: <strong>{$data['password']}</strong></p>
        ";

        // Send welcome email
        // Mail::to($user->email)->send(new welcomeEmail($wMessage));

        return $user; // Return the created user instance
    }
}
