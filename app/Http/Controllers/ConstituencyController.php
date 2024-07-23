<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\Constituency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ConstituencyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/constituencies",
     *     summary="Get list of constituencies",
     *     tags={"Constituencies"},
     *     @OA\Response(
     *         response=200,
     *         description="Constituencies retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Constituency"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15); // Default to 15 items per page
        $countyId = $request->input('county_id');
        $countyName = $request->input('county_name');
    
        $query = Constituency::query();
    
        if ($countyId) {
            $query->where('county_id', $countyId);
        }
    
        if ($countyName) {
            $query->whereHas('county', function($q) use ($countyName) {
                $q->where('county_name', 'like', "%$countyName%");
            });
        }
    
        $constituencies = $query->paginate($perPage);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Constituencies retrieved successfully',
            'data' => $constituencies
        ], 200);
    }
    

    /**
     * @OA\Post(
     *     path="/api/constituencies",
     *     summary="Create a new constituency",
     *      tags={"Constituencies"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"county_id", "constituency_name"},
     *             @OA\Property(property="county_id", type="integer", example=1),
     *             @OA\Property(property="constituency_name", type="string", example="Westlands")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Constituency created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Constituency")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'county_id' => 'required|exists:counties,id',
            'constituency_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $constituency = Constituency::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Constituency created successfully',
            'data' => $constituency
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/constituencies/{id}",
     *     summary="Get a constituency by ID",
     *      tags={"Constituencies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Constituency retrieved successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Constituency")
     *     )
     * )
     */
    public function show($id)
    {
        $constituency = Constituency::find($id);

        if (!$constituency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Constituencys not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Constituency retrieved successfully',
            'data' => $constituency
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/constituencies/{id}",
     *     summary="Update a constituency",
     *      tags={"Constituencies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"county_id", "constituency_name"},
     *             @OA\Property(property="county_id", type="integer", example=1),
     *             @OA\Property(property="constituency_name", type="string", example="Westlands")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Constituency updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Constituency")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $constituency = Constituency::find($id);

        if (!$constituency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Constituency not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'county_id' => 'required|exists:counties,id',
            'constituency_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $constituency->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Constituency updated successfully',
            'data' => $constituency
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/constituencies/{id}",
     *     summary="Delete a constituency",
     *      tags={"Constituencies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Constituency deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        $constituency = Constituency::find($id);

        if (!$constituency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Constituency not found'
            ], 404);
        }

        $constituency->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Constituency deleted successfully'
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/constituencies/search/{query}",
     *     summary="Search for constituencies",
     *      tags={"Constituencies"},
     *     @OA\Parameter(
     *         name="query",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Search results retrieved successfully",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Constituency"))
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
        $constituencyName = $request->query('constituency_name');
    
        if (empty($constituencyName)) {
            return response()->json([
                'status' => 'error',
                'message' => 'constituency_name query parameter is required'
            ], 400);
        }
    
        $constituencies = Constituency::where('constituency_name', 'LIKE', '%' . $constituencyName . '%')->get();
    
        if ($constituencies->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No constituencies found matching the specified name'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Constituencies retrieved successfully',
            'data' => $constituencies
        ], 200);
    }
    
    public function getWardsByConstituency($constituency_id)
    {
        $wards = Ward::where('constituency_id', $constituency_id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Wards retrieved successfully',
            'data' => $wards
        ], 200);
    }

    public function getWardsByCountyAndConstituency($county_id, $constituency_id)
    {
        $wards = Ward::whereHas('constituency', function($query) use ($county_id, $constituency_id) {
            $query->where('county_id', $county_id)
                ->where('id', $constituency_id);
        })->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Wards retrieved successfully',
            'data' => $wards
        ], 200);
    }



    
}
