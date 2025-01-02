<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //when using a function ->
    //when applying a rule within an attribute
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //error
    // //function created to use the relationship
    // public function getProfile1($id){
    //     $profile = User::findOrFail($id)->profile();
    //     return response()->json($profile, 200);
    // }

    public function getProfile($id)
    {
        // Fetch user and related profile
        $user = User::findOrFail($id);
        // Access the profile via the relationship property
        $profile = $user->profile;
        // Return profile as JSON
        return response()->json($profile, 200);
    }

    public function getUserTasks($id)
    {
        // Find the user by ID, or fail if not found
        $user = User::findOrFail($id);

        // Access the user's tasks using the relationship
        $tasks = $user->tasks;

        // Return the tasks as a JSON response
        return response()->json($tasks, 200);
    }

    /**
     * public function getUserTasks($id){
     *      $tasks = User::findOrFail($id)->tasks;
     *      return response()->json($tasks, 200);
     * }
     */
}
