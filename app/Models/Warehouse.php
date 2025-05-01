<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'location', 'type',
        'temperature', 'humidity', 'description', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'temperature' => 'float',
        'humidity' => 'float',
    ];

     const TYPES = [
        'main' => 'Main',
        'cold' => 'Cold Storage',
        'frozen' => 'Frozen Storage',
        'dry' => 'Dry Storage'
    ];

    public function storageLocations()
    {
        return $this->hasMany(StorageLocation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
