<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cite;
use App\Http\Requests\StoreCiteRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Http\Resources\CiteResource;

class CiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cites = Cite::all();

        return CiteResource::collection($cites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCiteRequest $request)
    {
        $cite = Cite::create($request->validated());

        return new CiteResource($cite);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cite = Cite::findOrFail($id);

        return new CiteResource($cite);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCiteRequest $request, string $id)
    {
        $cite = Cite::findOrFail($id);

        $cite->update($request->validated());

        return new CiteResource($cite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cite = Cite::findOrFail($id);

        $cite->delete();

        return response()->json(null, 204);
    }
}
