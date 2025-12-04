<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\HttpResponses;
use App\Http\Resources\Hatagtask;
use App\Http\Requests;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TaskController extends Controller 
{
    use HttpResponses;
    //
    // Get all tasks for authenticated user
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return $this->success(Hatagtask::collection($tasks), 'Tasks retrieved successfully');
    }

    // Create a new task
    public function store(Taskrequest $request)
    {
        $validated = $request->validated();

        $task = Task::create([
            'title'   => $validated['title'],
            'description'=> $validated['description'],
            'author'     => $validated['author'],
            
        ]);

        return $this->success(new Hatagtask($task), 'Task created successfully', 201);
    }

     // Show a single task
    public function show(Task $task)
{
    if ($task->user_id !== Auth::id()) {
        return $this->error(null, 'Task not found', 404);
    }

    return $this->success(new Hatagtask($task), 'Task retrieved successfully');
}


   public function destroy(Request $request)
{
    $request->validate(['id' => 'required|integer']);

    try {
        $task = Task::findOrFail($request->id);  // <- no user_id filter
        $task->delete();

        return $this->success(null, 'Task deleted successfully');
    } catch (ModelNotFoundException $e) {
        return $this->error(null, 'Task not found', 404);
    }
}

public function update(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'title' => 'required|string'
    ]);

    try {
        $task = Task::findOrFail($request->id);   // no user_id check

        $task->update([
            'title' => $request->title
        ]);

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ]);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Task not found'], 404);
    }
}





}
