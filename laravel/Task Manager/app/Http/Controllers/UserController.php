<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['message' => 'Registration Succeded', 'User' => $user], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'invalid email or password'], 401);
        } else {
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_Token')->plainTextToken;
            return response()->json(['message' => 'Login Successful', 'User' => $user, 'Token' => $token], 201);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logged out']);
    }

    public function getProfile($id)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($id);
        $profile = $user->profile;
        if($profile->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($profile, 200);
    }

    public function getUserTasks($id)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($id);
        $tasks = $user->tasks;
        if($tasks->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($tasks, 200);
    }

}
