<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseCoordinate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'x',
        'y',
        'z',
    ];
}
