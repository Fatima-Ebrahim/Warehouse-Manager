<?php

namespace App\Repositories;

use App\Models\Warehouse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WarehouseRepository
{
    protected $model;

    public function __construct(Warehouse $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPaginated( $perPage = 10)
    {
        return $this->model->with('storageLocations')->paginate($perPage);
    }

    public function findById( $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update( $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function delete( $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function getByType(string $type)
    {
        return $this->model->where('type', $type)->get();
    }

    public function getWithLocations( $id)
    {
        return $this->model->with('storageLocations')->findOrFail($id);
    }
}
