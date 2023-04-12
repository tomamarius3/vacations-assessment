<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetVacationsRequest;
use App\Models\Vacation;
use App\Http\Requests\StoreVacationRequest;
use App\Http\Requests\UpdateVacationRequest;
use App\Services\VacationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class VacationController extends Controller
{
    private VacationService $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function index(GetVacationsRequest $request): JsonResponse
    {
        return response()->json($this->vacationService->getAllVacations(
            $request->getFilters(),
            $request->get('limit', 0),
            $request->get('offset', 0)
        ));
    }

    public function store(StoreVacationRequest $request): JsonResponse
    {
        try {
            $this->vacationService->storeVacation($request->validated());
        } catch (Throwable $t) {
            return response()->json($t->getMessage(), 500);
        }

        return response()->json(null, 201);
    }

    public function show(int $vacationId): JsonResponse
    {
        $vacation = $this->vacationService->getVacation($vacationId);

        if (is_null($vacation)) {
            return response()->json(null, 404);
        }

        return response()->json($vacation);
    }

    public function update(UpdateVacationRequest $request, int $vacationId): JsonResponse
    {
        try {
            $this->vacationService->updateVacation($vacationId, $request->validated());
        } catch(NotFoundHttpException $exception) {
            return response()->json(null, 404);
        } catch (Throwable $t) {
            return response()->json($t->getMessage(), 500);
        }

        return response()->json();
    }

    public function destroy(int $vacationId): JsonResponse
    {
        try {
            $this->vacationService->deleteVacation($vacationId);
        } catch(NotFoundHttpException $exception) {
            return response()->json(null, 404);
        } catch (Throwable $t) {
            return response()->json($t->getMessage(), 500);
        }
        return response()->json(null, 200);
    }
}
