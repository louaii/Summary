<?php

namespace App\Http\Controllers;

//import model task
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    //Create function to read data named index
    public function index(){
        $task = Task::all();
        return response()->json($task, 200);
    }

    //Create function named store to add data to the database
    public function store(Request $request)
    {
        $task = Task::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'priority'=>$request->priority
        ]);
        return response()->json($task, 201);
    }

    //Updating function that update database based on id
    public function update(Request $request, $id){
        $task=Task::findOrFail($id);
        $task->update($request->only('title', 'description', 'priority'));
        return response()->json($task, 200);

    }

    //Show to retrieve data and show it's content based on id
    public function show($id){
        $task = Task::find($id);
        return response()->json($id, 200);
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
