<?php

namespace App\Http\Controllers\WarehouseKeeper;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignZoneToCoordinateRequest;
use App\Http\Requests\StoreShelfRequest;
use App\Http\Requests\StoreZoneRequest;
use App\Services\WarehouseDesignService;
use Illuminate\Http\Request;

class WarehouseDesignController extends Controller
{
    protected $warehouseDesignService;

    public function __construct(WarehouseDesignService $warehouseDesignService)
    {
        $this->warehouseDesignService = $warehouseDesignService;
    }

    public function indexCoordinate()
    {
        try {
            $coordinates = $this->warehouseDesignService->getAllCoordinates();
            return response()->json([
                'success' => true,
                'data' => $coordinates,
                'message' => $coordinates->isEmpty() ? 'No coordinates found' : 'Coordinates retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve coordinates',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function storeCoordinate(Request $request)
    {
        $validated = $request->validate([
            'coordinates' => 'required|array',
            'coordinates.*.x' => 'required|numeric',
            'coordinates.*.y' => 'required|numeric',
            'coordinates.*.z' => 'required|numeric',

        ]);

        try {
            $createdCoordinates = [];

            foreach ($validated['coordinates'] as $coordinateData) {
                $createdCoordinates[] = $this->warehouseDesignService->createCoordinate($coordinateData);
            }

            return response()->json([
                'success' => true,
                'data' => $createdCoordinates,
                'message' => 'Coordinates created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create coordinates',
                'error' => $e->getMessage()
            ], 500);
        }}
        public function assignZone(AssignZoneToCoordinateRequest $request, int $id)
    {
        $coordinate = $this->warehouseDesignService->assignZone($id, $request->zone_id);
        return response()->json($coordinate);
    }
    public function storeZone(StoreZoneRequest $request)
    {
        $zone = $this->warehouseDesignService->createZone($request->validated());
        return response()->json($zone, 201);
    }

    public function showCoordinate($id)
    {
        $coordinate = $this->warehouseDesignService->getCoordinateById($id);
        return response()->json($coordinate);
    }
    public function storeShelf(StoreShelfRequest $request)
    {
        $shelf = $this->warehouseDesignService->createShelf($request->validated());
        return response()->json($shelf, 201);
    }


    public function destroyCoordinate($id)
    {
        $this->warehouseDesignService->deleteCoordinate($id);
        return response()->json(null, 204);
    }
    //    public function update(Request $request, $id)
//    {
//        $validated = $request->validate([
//            'name' => 'nullable|string|max:255',
//            'x' => 'sometimes|numeric',
//            'y' => 'sometimes|numeric',
//            'z' => 'sometimes|numeric',
//            'description' => 'nullable|string',
//        ]);
//
//        $coordinate = $this->warehouseDesignService->updateCoordinate($id, $validated);
//        return response()->json($coordinate);
//    }
}
