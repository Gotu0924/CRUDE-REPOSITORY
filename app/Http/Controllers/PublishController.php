<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublishRequest;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Task;
use App\Http\Resources\Hatagtask;
use App\Http\Resources\PublishTask;
use App\Models\Publishon;
use Illuminate\Support\Facades\Auth;

class PublishController extends Controller
{
    //
    use HttpResponses;

    // Get all tasks for authenticated user
    public function index()
    {
        $tasks = Publishon::where('user_id', Auth::id())->get();
        return $this->success(PublishTask::collection($tasks), 'Tasks retrieved successfully');
    }

    
        public function publishon(PublishRequest $request)
        {
            $validated = $request->validated();

            // Step 1: Find the task by ID
            $task = Task::findOrFail($validated['id']);

            // Step 2: Update the status in the tasks table
            $task->status = $validated['status'];
            $task->save();

            // Step 3: Insert into the publish table
            $publish = Publishon::create([
                'title'       => $task->title,
                'description' => $task->description,
                'author'      => $task->author,
                'published_on'=> $validated['published_on'],
                'status'      => $task->status,
                'user_id'     => $task->user_id,
                'task_id'     => $task->id, // optional, if you want to link back to tasks
            ]);

            // Step 4: Return the response
            return $this->success($publish, 'Task published successfully', 201);
        }
}
