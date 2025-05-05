<?php

namespace App\Services;

use App\Repositories\WarehouseDesignRepository;

class WarehouseDesignService
{
    protected $warehouseDesignRepository;

    public function __construct(warehouseDesignRepository $warehouseDesignRepository)
    {
        $this->warehouseDesignRepository = $warehouseDesignRepository;
    }

    public function getAllCoordinates()
    {
        return $this->warehouseDesignRepository->all();
    }

    public function getCoordinateById($id)
    {
        return $this->warehouseDesignRepository->find($id);
    }

    public function createCoordinate(array $data)
    {
        return $this->warehouseDesignRepository->create($data);
    }

//    public function updateCoordinate($id, array $data)
//    {
//        return $this->warehouseCoordinateRepository->update($id, $data);
//    }

    public function deleteCoordinate($id)
    {
        return $this->warehouseDesignRepository->delete($id);
    }

//    public function paginateCoordinates($perPage = 10)
//    {
//        return $this->warehouseCoordinateRepository->paginate($perPage);
//    }
}
