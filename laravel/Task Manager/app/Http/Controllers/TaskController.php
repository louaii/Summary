<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function getCategoryTasks($category_id){
        $user_id = Auth::user()->id;
        $category= Category::findOrFail($category_id);
        $tasks = $category->tasks;
        if($tasks->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($tasks, 200);
    }

    public function getTaskCategories($task_id){
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($task_id);
        if($task->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized', 403]);
        $categories = $task->categories;
        return response()->json($categories, 200);
    }

    public function addCategoriesToTask(Request $request,$task_id){
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($task_id);
        if($task->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        $task->categories()->attach($request->category_id);
        return response()->json('Category attached successfully', 200);
    }

    //lazy load
    public function getTaskUser($id){
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($task->user, 200);
    }

    public function index()
    {
        $task = Auth::user()->tasks;
        return response()->json($task, 200);
    }

    public function getTaskByPriority(){
        //error from VS needs extensions and not actual error
        $task = Auth::user()->tasks()->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")->get();
        return response()->json($task, 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $validate = $request->validated();
        $validate['user_id']=$user_id;
        $task = Task::create($validate);
        return response()->json($task, 201);
    }

    public function show(int $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message' => 'Unauthorized'], 403);
        return response()->json($task, 200);
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $user_id = Auth::user()->id;
        $task=Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message'=> 'Unauthorized'],403);
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    public function destroy(int $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
            return response()->json(['message'=> 'Unauthorized'], 403);
        $task->delete();
        return response()->json(null, 204);
    }

    public function getAllTasks(){
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }
}
