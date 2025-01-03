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
        //attach($request->category_id) inserts a new record into the pivot table used in many to many pivot table
        $task->categories()->attach($request->category_id);
        return response()->json('Category attached successfully', 200);
    }

    public function getTaskUser($id){
        $user = Task::findOrFail($id);
        //$tasks = $user->$tasks;
        return response()->json($user, 200);
    }

    /**
     * public function getTaskUser($id){
     *      $user = Task::findOrFail($id)->user;
     *      return response()->json($task, 200);
     * }
     */

    /**
     * Display a listing of the resource.
     */
    //Create function to read data named index
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
        $task = Task::find($id);
        return response()->json($id, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    //Updating function that update database based on id
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task=Task::findOrFail($id);
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //Delete row from database based on id
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
