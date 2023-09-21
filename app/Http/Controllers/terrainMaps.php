<?php

namespace App\Http\Controllers;

use App\Models\homes;
use App\Models\terrain;
use Illuminate\Http\Request;

class terrainMaps extends Controller
{

    public function index()
    {
        $terrain = terrain::get();

        return view('terrains.form', ['data' => $terrain]);
    }

    public function save(Request $request)
    {
        $data = [
            'lat' => $request->lat,
            'lng' => $request->lng,
            'name' => $request->name
        ];
        terrain::create($data);
        return redirect()->route('terrains');
    }

    public function edit($id)
    {
        $data = terrain::find($id);
        return view('terrains.form', ['data' => $data]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'lat' => $request->lat,
            'lng' => $request->lng,
            'name' => $request->name
        ];
        terrain::find($id)->update($data);

        return redirect()->route('terrains');
    }

    public function delete($id)
    {
        terrain::find($id)->delete();
        return redirect()->route('terrains');
    }

    public function show($id)
    {
        $data = terrain::find($id);

        if (!$data) {
            return response()->json(['error' => 'data not found'], 404);
        }

        return response()->json($data);
    }

    public function getTerrainCount()
    {
        $TerrainCount = terrain::count();
        return $TerrainCount;
    }

}
