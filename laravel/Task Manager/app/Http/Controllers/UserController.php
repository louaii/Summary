<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
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

    public function getProfile($id){
    // Fetch user and related profile
    $user = User::findOrFail($id);
    // Access the profile via the relationship property
    $profile = $user->profile;
    // Return profile as JSON
    return response()->json($profile, 200);
    }

    public function getUserTasks($id){
        $user = User::findOrFail($id);
        $tasks = $user->$tasks;
        return response()->json($tasks, 200);
    }

    /**
     * public function getUserTasks($id){
     *      $tasks = User::findOrFail($id)->tasks;
     *      return response()->json($tasks, 200);
     * }
     */
}
