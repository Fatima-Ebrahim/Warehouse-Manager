<?php

namespace App\Http\Resources;

use App\Models\Warehouse;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'location' => $this->location,
            'type' => $this->type,
            'type_label' => Warehouse::TYPES[$this->type] ?? 'Unknown',
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'links' => [
                'self' => route('api.warehouses.show', $this->id),
                'storage_locations' => route('api.warehouses.storage-locations.index', $this->id)
            ]
        ];
    }
}
