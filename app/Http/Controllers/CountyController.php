<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class CountyController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/counties",
     *     summary="Get list of counties",
     *     tags={"Counties"},
     *     @OA\Response(
     *         response=200,
     *         description="Counties retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/County"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15); // Default to 15 items per page
        $counties = County::paginate($perPage);
        return response()->json([
            'status' => 'success',
            'message' => 'Counties retrieved successfully',
            'data' => $counties
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/counties",
     *     summary="Create a new county",
     *      tags={"Counties"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"county_name"},
     *             @OA\Property(property="county_name", type="string", example="Nairobi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="County created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/County")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'county_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $county = County::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'County created successfully',
            'data' => $county
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/counties/{id}",
     *     summary="Get a county by ID",
     *     tags={"Counties"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="County retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/County")
     *     )
     * )
     */
    public function show($id)
    {
        $county = County::find($id);

        if (!$county) {
            return response()->json([
                'status' => 'error',
                'message' => 'County not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'County retrieved successfully',
            'data' => $county
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/counties/{id}",
     *     summary="Update a county",
     *     tags={"Counties"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"county_name"},
     *             @OA\Property(property="county_name", type="string", example="Nairobi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="County updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/County")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $county = County::find($id);

        if (!$county) {
            return response()->json([
                'status' => 'error',
                'message' => 'County not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'county_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $county->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'County updated successfully',
            'data' => $county
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/counties/{id}",
     *     summary="Delete a county",
     *      tags={"Counties"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="County deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $county = County::find($id);

        if (!$county) {
            return response()->json([
                'status' => 'error',
                'message' => 'County not found'
            ], 404);
        }

        $county->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'County deleted successfully'
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/counties/search/{query}",
     *     summary="Search for counties",
     *      tags={"Counties"},
     *     @OA\Parameter(
     *         name="query",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Search results retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/County"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No results found for the given query",
     *         @OA\JsonContent(type="array", @OA\Items())
     *     )
     * )
     */
    public function search($query, Request $request)
    {
        $perPage = $request->input('per_page', 15); // Default to 15 items per page
        $counties = County::where('county_name', 'like', "%$query%")
            ->orWhere('id', $query)
            ->paginate($perPage);

        if ($counties->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No results found for the given query',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Search results retrieved successfully',
            'data' => $counties
        ], 200);
    }
    
}
