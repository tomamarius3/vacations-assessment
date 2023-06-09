<?php

namespace App\Repositories\Interfaces;

use App\Models\Vacation;
use Illuminate\Database\Eloquent\Collection;

interface VacationRepositoryInterface
{
    public function findAll(array $filters, int $limit, int $offset): Collection;

    public function findById(int $id): ?Vacation;

    public function store(array $data): Vacation;

    public function update(int $id, array $data): void;

    public function delete(int $id): void;
}
