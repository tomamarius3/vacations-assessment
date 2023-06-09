<?php

namespace App\Repositories;

use App\Models\Vacation;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VacationRepository implements VacationRepositoryInterface
{

    public function findAll(array $filters, int $limit = 10, int $offset = 0): Collection
    {
        $vacations = Vacation::query();

        if ($limit > 0) {
            $vacations = $vacations->limit($limit)->offset($offset);
        }

        foreach ($filters as $field => $filter) {
            $operator = array_key_first($filter);
            $value = $filter[$operator];
            $vacations = $vacations->where($field, $this->getMappedOperator($operator), $value);
        }

        return $vacations->get();
    }

    private function getMappedOperator(string $operator): string
    {
        $operators = [
            'eq' => '=',
            'gte' => '>=',
            'lte' => '<='
        ];

        return $operators[$operator];
    }

    public function findById(int $id): ?Vacation
    {
        return Vacation::find($id);
    }

    public function store(array $data): Vacation
    {
        return Vacation::create($data);
    }

    public function update(int $id, array $data): void
    {
        $vacation = $this->findById($id);

        if (is_null($vacation)) {
            throw new NotFoundHttpException("There is no vacation with id: $id");
        }

        $vacation->start = $data['start'];
        $vacation->end = $data['end'];
        $vacation->price = $data['price'];

        $vacation->save();
    }

    public function delete(int $id): void
    {
        $vacation = $this->findById($id);

        if (is_null($vacation)) {
            throw new NotFoundHttpException("There is no vacation with id: $id");
        }

        $vacation->delete();
    }
}
