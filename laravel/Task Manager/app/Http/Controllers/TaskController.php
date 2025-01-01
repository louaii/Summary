<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Create function to read data named index
    public function index()
    {
        $task = Task::all();
        return response()->json($task, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    //Create function named store to add data to the database
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
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
