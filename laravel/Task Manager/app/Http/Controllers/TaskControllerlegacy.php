<?php

namespace App\Http\Controllers;

//import model task
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskControllerlegacy extends Controller
{

    //Create function to read data named index
    public function index(){
        $task = Task::all();
        return response()->json($task, 200);
    }

    //Create function named store to add data to the database
    public function store(StoreTaskRequest $request){
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    //Updating function that update database based on id
    public function update(UpdateTaskRequest $request, $id){
        $task=Task::findOrFail($id);
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    //Show to retrieve data and show it's content based on id
    public function show($id){
        $task = Task::find($id);
        return response()->json($id, 200);
    }

    //Delete row from database based on id
    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
