<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenceType\StoreLicenceTypeRequest;
use App\Http\Requests\LicenceType\UpdateLicenceTypeRequest;
use App\Http\Resources\LicenceTypeResource;
use App\Models\LicenceType;
use Illuminate\Http\Request;

class LicenceTypeController extends Controller
{
    public function index()
    {
        $licenceType = LicenceType::all();

        return response()->json([
            'status' => 'success',
            'data' => LicenceTypeResource::collection($licenceType),
        ], 200);
    }

    public function store(StoreLicenceTypeRequest $request)
    {
        $validated = $request->validated();
        $licenceType = LicenceType::query()->create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Licence Type created successfully',
            'data' => new LicenceTypeResource($licenceType),
        ], 201);
    }

    public function show(LicenceType $licenceType)
    {
        return response()->json([
            'status' => 'success',
            'data' => new LicenceTypeResource($licenceType),
        ], 200);
    }

    public function update(UpdateLicenceTypeRequest $request, LicenceType $licenceType)
    {
        $validated = $request->validated();
        $licenceType->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Licence Type updated successfully',
            'data' => new LicenceTypeResource($licenceType),
        ], 200);

    }

    public function destroy(LicenceType $licenceType)
    {
        $licenceType->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Licence Type deleted successfully',
        ], 200);
    }
}
