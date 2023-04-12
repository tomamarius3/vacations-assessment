<?php

namespace App\Services;

use App\Models\Vacation;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class VacationService
{

    private $vacationRepository;

    public function __construct(VacationRepositoryInterface $vacationRepository)
    {
        $this->vacationRepository = $vacationRepository;
    }

    public function getAllVacations(array $filters, int $limit, int $offset): Collection
    {
        return $this->vacationRepository->findAll($filters, $limit, $offset);
    }

    public function getVacation(int $id): ?Vacation
    {
        return $this->vacationRepository->findById($id);
    }

    public function storeVacation(array $data): void
    {
        $this->vacationRepository->store($data);
    }

    public function updateVacation(int $id, array $data): void
    {
        $this->vacationRepository->update($id, $data);
    }

    public function deleteVacation(int $id): void
    {
        $this->vacationRepository->delete($id);
    }
}
