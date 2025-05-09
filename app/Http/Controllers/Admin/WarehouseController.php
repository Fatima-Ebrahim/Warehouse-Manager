<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Services\WarehouseService;


class WarehouseController extends Controller
{
    protected $service;

    public function __construct(WarehouseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAllWarehouses()->response();
    }

    public function store(StoreWarehouseRequest $request)
    {
        return $this->service->createWarehouse($request->validated())
            ->response()
            ->setStatusCode(201);
    }

    public function show( $id)
    {
        return $this->service->getWarehouse($id)->response();
    }

    public function update(UpdateWarehouseRequest $request, int $id)
    {
        return $this->service->updateWarehouse($id, $request->validated())
            ->response();
    }

    public function destroy(int $id)
    {
        return $this->service->deleteWarehouse($id);
    }

    public function byType(string $type)
    {
        return $this->service->getWarehousesByType($type)->response();
    }
}
