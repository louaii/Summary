<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::all();
        return response()->json($profile, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $profile = Profile::create($request->validated());
        return response()->json(['message' => 'Profile created Successfully', 'profile' => $profile], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $profile = Profile::where('user_id',$id)->firstOrFail(); //first value gotten will be shown
        return response()->json($profile, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, int $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->validated());
        return response()->json($profile, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return response()->json(null, 204);
    }
}
