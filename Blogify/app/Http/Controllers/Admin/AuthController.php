<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            if ($user->role_id !== 1) {
                return response()->json(['error' => "Unauthorized Access: You're not an admin"], 403);
            }

            $response = Http::asForm()->post(url('/oauth/token'), [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username' => $validated['email'],
                'password' => $request->input('password'),
                'scope' => '',
            ]);

            return $response->json();
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role_id' => 'required|min:1|max:3'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id']
        ]);

        return response()->json(['message' => 'sccessful creation']);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard')->with('successful', 'Account created successfully');
    }

}
