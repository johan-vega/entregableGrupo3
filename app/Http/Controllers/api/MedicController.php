<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Medic;
use App\Http\Requests\StoreMedicRequest;
use App\Http\Requests\UpdateMedicRequest;
use App\Http\Resources\MedicResource;

class MedicController extends Controller
{
    public function index()
    {
        $medics = Medic::all();

        return MedicResource::collection($medics);
    }

    public function store(StoreMedicRequest $request)
    {
        $medic = Medic::create($request->validated());

        return new MedicResource($medic);
    }

    public function show(string $id)
    {
        $medic = Medic::findOrFail($id);

        return new MedicResource($medic);
    }

    public function update(UpdateMedicRequest $request, string $id)
    {
        $medic = Medic::findOrFail($id);

        $medic->update($request->validated());

        return new MedicResource($medic);
    }

    public function destroy(string $id)
    {
        $medic = Medic::findOrFail($id);

        $medic->delete();

        return response()->json(null, 204);
    }
}
