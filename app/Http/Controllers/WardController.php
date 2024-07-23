<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WardController extends Controller
{
       /**
     * @OA\Get(
     *     path="/api/wards",
     *     summary="Get list of wards",
     *     tags={"Wards"},
     *     @OA\Response(
     *         response=200,
     *         description="Wards retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Ward"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15); // Default to 15 items per page
        $wards = Ward::paginate($perPage);
        return response()->json([
            'status' => 'success',
            'message' => 'Wards retrieved successfully',
            'data' => $wards
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/wards",
     *     summary="Create a new ward",
     * tags={"Wards"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"constituency_id", "ward_name"},
     *             @OA\Property(property="constituency_id", type="integer", example=1),
     *             @OA\Property(property="ward_name", type="string", example="Parklands")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ward created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Ward")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'constituency_id' => 'required|exists:constituencies,id',
            'ward_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $ward = Ward::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Ward created successfully',
            'data' => $ward
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/wards/{id}",
     *     summary="Get a ward by ID",
     * tags={"Wards"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ward retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Ward")
     *     )
     * )
     */
    public function show($id)
    {
        $ward = Ward::find($id);

        if (!$ward) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ward not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Ward retrieved successfully',
            'data' => $ward
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/wards/{id}",
     *     summary="Update a ward",
     * tags={"Wards"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"constituency_id", "ward_name"},
     *             @OA\Property(property="constituency_id", type="integer", example=1),
     *             @OA\Property(property="ward_name", type="string", example="Parklands")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ward updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Ward")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $ward = Ward::find($id);

        if (!$ward) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ward not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'constituency_id' => 'required|exists:constituencies,id',
            'ward_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $ward->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Ward updated successfully',
            'data' => $ward
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/wards/{id}",
     *     summary="Delete a ward",
     * tags={"Wards"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Ward deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $ward = Ward::find($id);

        if (!$ward) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ward not found'
            ], 404);
        }

        $ward->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Ward deleted successfully'
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/wards/search/{query}",
     *     summary="Search for wards",
     * tags={"Wards"},
     *     @OA\Parameter(
     *         name="query",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Search results retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Ward"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No results found for the given query",
     *         @OA\JsonContent(type="array", @OA\Items())
     *     )
     * )
     */
    public function search(Request $request)
    {
        $wardName = $request->query('ward_name');
    
        if (empty($wardName)) {
            return response()->json([
                'status' => 'error',
                'message' => 'ward_name query parameter is required'
            ], 400);
        }
    
        $wards = Ward::where('ward_name', 'LIKE', '%' . $wardName . '%')->get();

        if ($wards->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No wards found matching the specified name'
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Wards retrieved successfully',
            'data' => $wards
        ], 200);
    }
    
    
}
