<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shelf extends Model
{
protected $fillable = [
'code',
'warehouse_coordinate_id',
'width',
'length',
'height',
'levels'
];

public function coordinate(): BelongsTo
{
return $this->belongsTo(WarehouseCoordinate::class, 'warehouse_coordinate_id');
}
}
