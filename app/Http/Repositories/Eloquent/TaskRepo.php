<?php


namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepoInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepo implements TaskRepoInterface
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $task = $this->model->find($id);
        if ($task) {
            return $task->update($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $task = $this->model->find($id);
        if ($task) {
            return $task->delete();
        }
        return false;
    }
}
