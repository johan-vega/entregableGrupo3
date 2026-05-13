<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Http\Resources\TreatmentResource;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::all();

        return TreatmentResource::collection($treatments);
    }

    public function store(StoreTreatmentRequest $request)
    {
        $treatment = Treatment::create($request->validated());

        return new TreatmentResource($treatment);
    }

    public function show(string $id)
    {
        $treatment = Treatment::findOrFail($id);

        return new TreatmentResource($treatment);
    }

    public function update(UpdateTreatmentRequest $request, string $id)
    {
        $treatment = Treatment::findOrFail($id);

        $treatment->update($request->validated());

        return new TreatmentResource($treatment);
    }

    public function destroy(string $id)
    {
        $treatment = Treatment::findOrFail($id);

        $treatment->delete();

        return response()->json(null, 204);
    }
}
