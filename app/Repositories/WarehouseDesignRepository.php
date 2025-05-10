<?php

namespace App\Repositories;

use App\Models\Shelf;
use App\Models\WarehouseCoordinate;
use App\Models\Zone;


class WarehouseDesignRepository
{

    public function assignZoneToCoordinate(int $coordinateId, int $zoneId)
    {
        $coordinate = WarehouseCoordinate::findOrFail($coordinateId);
        $coordinate->zone_id = $zoneId;
        $coordinate->save();
        return $coordinate;
    }

    public function all()
    {
        return WarehouseCoordinate::all();
    }

    public function find($id)
    {
        return WarehouseCoordinate::findOrFail($id);
    }

    public function create(array $data)
    {
        return WarehouseCoordinate::create($data);
    }

//    public function update($id, array $data)
//    {
//        $coordinate = $this->find($id);
//        $coordinate->update($data);
//        return $coordinate;
//    }

    public function delete($id)
    {
        $coordinate = $this->find($id);
        return $coordinate->delete();
    }
    public function createZone(array $data)
    {
        return Zone::create($data);
    }
    public function createShelf(array $data)
    {
        return Shelf::create($data);
    }
//    public function paginate($perPage = 10)
//    {
//        return WarehouseCoordinate::paginate($perPage);
//    }
}
