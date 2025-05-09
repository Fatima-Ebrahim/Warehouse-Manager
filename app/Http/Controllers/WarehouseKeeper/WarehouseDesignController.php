<?php

namespace App\Http\Controllers\WarehouseKeeper;

use App\Http\Controllers\Controller;
use App\Services\WarehouseDesignService;
use Illuminate\Http\Request;

class WarehouseDesignController extends Controller
{
    protected $warehouseDesignService;

    public function __construct(WarehouseDesignService $warehouseDesignService)
    {
        $this->warehouseDesignService = $warehouseDesignService;
    }

    public function index()
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

    public function store(Request $request)
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
        }
    }

    public function show($id)
    {
        $coordinate = $this->warehouseDesignService->getCoordinateById($id);
        return response()->json($coordinate);
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

    public function destroy($id)
    {
        $this->warehouseDesignService->deleteCoordinate($id);
        return response()->json(null, 204);
    }
}
