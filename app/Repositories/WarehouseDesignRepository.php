<?php

namespace App\Repositories;

use App\Models\WarehouseCoordinate;


class WarehouseDesignRepository
{
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

//    public function paginate($perPage = 10)
//    {
//        return WarehouseCoordinate::paginate($perPage);
//    }
}
