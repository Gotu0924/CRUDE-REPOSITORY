<?php
namespace App\Repositories\Contracts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepoInterface
{
public function paginate(int $perPage = 15): LengthAwarePaginator;
public function find(int $id);
public function create(array $data);
public function update(int $id, array $data): bool;
public function delete(int $id): bool;
}