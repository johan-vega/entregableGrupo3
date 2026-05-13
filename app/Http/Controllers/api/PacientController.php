<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pacient;
use App\Http\Requests\StorePacientRequest;
use App\Http\Requests\UpdatePacientRequest;
use App\Http\Resources\PacientResource;

class PacientController extends Controller
{
    public function index()
    {
        $pacients = Pacient::all();

        return PacientResource::collection($pacients);
    }

    public function store(StorePacientRequest $request)
    {
        $pacient = Pacient::create($request->validated());

        return new PacientResource($pacient);
    }

    public function show(string $id)
    {
        $pacient = Pacient::findOrFail($id);

        return new PacientResource($pacient);
    }

    public function update(UpdatePacientRequest $request, string $id)
    {
        $pacient = Pacient::findOrFail($id);

        $pacient->update($request->validated());

        return new PacientResource($pacient);
    }

    public function destroy(string $id)
    {
        $pacient = Pacient::findOrFail($id);

        $pacient->delete();

        return response()->json(null, 204);
    }
}
