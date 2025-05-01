<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;
use App\Http\Resources\WarehouseResource;
use App\Http\Resources\WarehouseCollection;
use Illuminate\Http\JsonResponse;

class WarehouseService
{
    protected $repository;

    public function __construct(WarehouseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllWarehouses(): WarehouseCollection
    {
        return new WarehouseCollection($this->repository->getPaginated());
    }

    public function getWarehouse(int $id): WarehouseResource
    {
        $warehouse = $this->repository->getWithLocations($id);
        return new WarehouseResource($warehouse);
    }

    public function createWarehouse(array $data): WarehouseResource
    {
        $warehouse = $this->repository->create($data);
        return new WarehouseResource($warehouse);
    }

    public function updateWarehouse(int $id, array $data): WarehouseResource
    {
        $this->repository->update($id, $data);
        return $this->getWarehouse($id);
    }

    public function deleteWarehouse(int $id): JsonResponse
    {
        $this->repository->delete($id);
        return response()->json(null, 204);
    }

    public function getWarehousesByType(string $type): WarehouseCollection
    {
        return new WarehouseCollection(
            $this->repository->getByType($type)
        );
    }
}
