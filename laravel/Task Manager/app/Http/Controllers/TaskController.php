<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function getCategoryTasks($category_id){
        $tasks = Task::findOrFail($category_id)->tasks;
        return response()->json($tasks, 200);
    }

    public function getTaskCategories($task_id){
        $categories = Task::findOrFail($task_id)->categories;
        return response()->json($categories, 200);
    }

    public function addCategoriesToTask(Request $request,$task_id){
        $task = Task::findOrFail($task_id);
        $task->categories()->attach($request->category_id);
        return response()->json('Category attached successfully', 200);
    }

    //basic changes if this is the find used:
    //$task = Task::with('user')->findOrFail($id); eager load
    //change the return to $task
    //the current used is faster as time complexity just retrieving the tasks and fetching all users data

    //lazy load
    public function getTaskUser($id){
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($task->user, 200);
    }

    /**
     * Display a listing of the resource.
     */
    //Create function to read data named index
    //only not to modify
    public function index()
    {
        $task = Auth::user()->tasks;
        return response()->json($task, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    //Create function named store to add data to the database
    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $validate = $request->validated();
        $validate['user_id']=$user_id;
        $task = Task::create($validate);
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    //Show to retrieve data and show it's content based on id
    public function show(int $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    //Updating function that update database based on id
    public function update(UpdateTaskRequest $request, int $id)
    {
        $user_id = Auth::user()->id;
        $task=Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message'=> 'Unauthorized'],403);
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //Delete row from database based on id
    public function destroy(int $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message'=> 'Unauthorized'], 403);
        $task->delete();
        return response()->json(null, 204);
    }
}
