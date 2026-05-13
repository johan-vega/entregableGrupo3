<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Http\Requests\StoreDiagnosticRequest;
use App\Http\Requests\UpdateDiagnosticRequest;
use App\Http\Resources\DiagnosticResource;

class DiagnosticController extends Controller
{
    public function index()
    {
        $diagnostics = Diagnostic::all();

        return DiagnosticResource::collection($diagnostics);
    }

    public function store(StoreDiagnosticRequest $request)
    {
        $diagnostic = Diagnostic::create($request->validated());

        return new DiagnosticResource($diagnostic);
    }

    public function show(string $id)
    {
        $diagnostic = Diagnostic::findOrFail($id);

        return new DiagnosticResource($diagnostic);
    }

    public function update(UpdateDiagnosticRequest $request, string $id)
    {
        $diagnostic = Diagnostic::findOrFail($id);

        $diagnostic->update($request->validated());

        return new DiagnosticResource($diagnostic);
    }

    public function destroy(string $id)
    {
        $diagnostic = Diagnostic::findOrFail($id);

        $diagnostic->delete();

        return response()->json(null, 204);
    }
}