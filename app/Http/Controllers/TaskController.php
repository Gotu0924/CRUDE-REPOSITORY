<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\HttpResponses;
use App\Http\Resources\Hatagtask;
use App\Http\Requests;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskreq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Services\Taskservices;


class TaskController extends Controller 
{

    protected $service;
    public function __construct(Taskservices $service)
    {
    $this->service = $service;
    }

    use HttpResponses;
    //
    // // Get all tasks for authenticated user
    // public function index()
    // {
    //     $tasks = Task::where('user_id', Auth::id())->get();
    //     return $this->success(Hatagtask::collection($tasks), 'Tasks retrieved successfully');
    // }

    public function index(){
        $tasks = $this->service->getAll();
        return $this->success(Hatagtask::collection($tasks), 'Tasks retrieved successfully');
    }
    
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $task = $this->service->create($data);
        return new Hatagtask($task);
    }


public function show(Task $task){
    $task = $this->service->get($id);
    return new Hatagtask($task);
}


public function destroy(Task $task){
    $this->service->delete($task->id);
return response()->json(['message' => 'Deleted']);
}

public function update (UpdateTaskreq $request , $id){
    $data = $request->validated();
    $task = $this->service->update($id, $data);
    return new Hatagtask($task);
}

// public function edit(TaskRequest $request)
// {
//     $data = $request->validated();
//     $task = $this->service->edit($data);
//     return new Hatagtask($task);
// }


    // Create a new task
    // public function store(TaskRequest $request)
    // {
    //     $validated = $request->validated();
        
    //     return $this->success(new Hatagtask($task), 'Task created successfully', 201);
    // }

     // Show a single task
//     public function show(Task $task)
// {
//     if ($task->user_id !== Auth::id()) {
//         return $this->error(null, 'Task not found', 404);
//     }

//     return $this->success(new Hatagtask($task), 'Task retrieved successfully');
// }


//    public function destroy(Request $request)
// {
//     $request->validate(['id' => 'required|integer']);

//     try {
//         $task = Task::findOrFail($request->id);  // <- no user_id filter
//         $task->delete();

//         return $this->success(null, 'Task deleted successfully');
//     } catch (ModelNotFoundException $e) {
//         return $this->error(null, 'Task not found', 404);
//     }
// }



// public function update(Request $request)
// {
//     $request->validate([
//         'id' => 'required|integer',
//         'title' => 'required|string',
//         'status' => 'required|string'
//     ]);

//     try {
//         $task = Task::findOrFail($request->id);   // no user_id check

//         $task->update([
//             'title' => $request->title,
//             'status' => $request->status
//         ]);

//         return response()->json([
//             'message' => 'Task updated successfully',
//             'task' => $task
//         ]);
//     } catch (ModelNotFoundException $e) {
//         return response()->json(['error' => 'Task not found'], 404);
//     }
// }





}
