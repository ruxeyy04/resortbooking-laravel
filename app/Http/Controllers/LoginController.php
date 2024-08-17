<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $usernameEmail = $request->input('loginUsername');
        $password = $request->input('loginPassword');
        $response = [];
    
        
        try {
            $user = User::where('username', $usernameEmail)
                ->orWhere('email', $usernameEmail)
                ->first();
    
            if ($user && Hash::check($password, $user->password)) {
                $minutes = 60;
                
                $token = $user->createToken('API-TOKEN')->plainTextToken;
                $cookie1 = Cookie::make('account_id', $user->account_id, $minutes);
                $cookie2 = Cookie::make('user_type', $user->user_type, $minutes);
                $cookie3 = Cookie::make('bearer_token', $token, $minutes);
                $response['success'] = true;
                $response['user_type'] = $user->user_type;
                $response['title'] = 'Login Successful';
                $response['text'] = 'Welcome ' . $user->username;
                $response['icon'] = 'success';
                $response['token'] = $token;
                return response()->json($response)->withCookie($cookie1)->withCookie($cookie2)->withCookie($cookie3);
            } else {
                $response['failed'] = true;
                $response['title'] = 'Login Unsuccessful';
                $response['text'] = 'Invalid username/email or password';
                $response['icon'] = 'error';
            }
    
        } catch (\Exception $e) {
            $response['error'] = 'Failed to login. Error: ' . $e->getMessage();
        }
    
        return response()->json($response);
    }

    public function register(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password'); // Use bcrypt for password hashing
        $contact_number = $request->input('contact_number');
        $user_type = $request->filled('user_type') ? $request->input('user_type') : 'customer';

        $response = [];

        try {
            $exists = User::where('email', $email)->exists();
            if ($exists) {
                $response['exists'] = "This email is already in use";
                return response()->json($response);
            }

            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'contact_number' => $contact_number,
                'user_type' => $user_type,
            ]);

            $useracc = $user->createToken('API-TOKEN')->plainTextToken;
            $response['title'] = 'Registered Successfully!';
            $response['text'] = 'You can now proceed to login';
            $response['icon'] = 'success';
        } catch (\Exception $e) {
            $response['failed'] = "Failed to add user. Error: " . $e->getMessage();
        }

        return response()->json($response);
    }
    public function logout()
    {
        try {
            $user = User::where('account_id', request()->cookie('account_id'))->first();
    
            if ($user) {
                $user->tokens()->where('name', 'API-TOKEN')->delete(); // Remove the token
            }
    
            // Remove cookies
            Cookie::queue(Cookie::forget('account_id'));
            Cookie::queue(Cookie::forget('user_type'));
            Cookie::queue(Cookie::forget('bearer_token'));
    
            return response()->json(['success' => true, 'message' => 'Logout successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to logout. Error: ' . $e->getMessage()]);
        }
    }
    
}
