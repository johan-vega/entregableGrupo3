<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Http\Requests\StoreMedicationRequest;
use App\Http\Requests\UpdateMedicationRequest;
use App\Http\Resources\MedicationResource;

class MedicationsController extends Controller
{
    public function index()
    {
        $medications = Medication::all();

        return MedicationResource::collection($medications);
    }

    public function store(StoreMedicationRequest $request)
    {
        $medication = Medication::create($request->validated());

        return new MedicationResource($medication);
    }

    public function show(string $id)
    {
        $medication = Medication::findOrFail($id);

        return new MedicationResource($medication);
    }

    public function update(UpdateMedicationRequest $request, string $id)
    {
        $medication = Medication::findOrFail($id);

        $medication->update($request->validated());

        return new MedicationResource($medication);
    }

    public function destroy(string $id)
    {
        $medication = Medication::findOrFail($id);

        $medication->delete();

        return response()->json(null, 204);
    }
}
