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
        return response()->json($task, 200);
    }

    //Updating function that update database based on id
    public function update(Request $request, $id){
        // 
    }
}
