<?php


namespace App\Services;
use App\Repositories\Contracts\TaskRepoInterface;


class Taskservices
        {
        protected $tasks;


        public function __construct(TaskRepoInterface $tasks)
        {
        $this->tasks = $tasks;
        }

        // public function getAll()
        // return $this->tasks->paginate();
        // {

        public function get($id)
        {
        return $this->tasks->find($id);

       }

       public function destroy($id)
       {
        return $this->tasks->delete($id);
       }

       public function update($id, $data)
       {
        return $this->tasks->update($id, $data);
       }

    //    public function edit($data)
    //    {
    //     return $this->tasks->create($data);
    //    }

    }

}