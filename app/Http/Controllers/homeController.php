<?php

namespace App\Http\Controllers;


use App\Models\category;
use App\Models\homes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



class homeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function store()
    {
        $home= homes::all();
        if (count($home)<=0){
            return response(["message"=>"aucune maison en vue"],200);
        }
        return response($home);
    }

    public function index()
    {
        $home = homes::get();

        return view('homes.index', ['data' => $home]);
    }

    public function add()
    {
        $category = category::get();

        return view('homes.form', ['category' => $category]);
    }


    public function save(Request $request)
    {
        $data = [
            'item_code' => $request->item_code,
            'localisation' => $request->localisation,
            'description' => $request->description,
            'bathrooms' => $request->bathrooms,
            'area' => $request->area,
            'model' => $request->model,
            'category' => $request->id_category,
            'price' => $request->price,
            'quartier'=>$request->quartier,
            'position'=>$request->position
        ];

        if ($request->hasFile('path')) {
            $imagePath = $request->file('path')->store('images', 'public');
            $data['path'] = $imagePath;
        } else {
            $data['path'] = 'default.jpg';
        }

        homes::create($data);
        return redirect()->route('homes');
    }



    public function edit($id)
    {
        $home = homes::find($id);
        $category = category::get();

        return view('homes.form', ['home' => $home, 'category' => $category]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'item_code' => $request->item_code,
            'localisation' => $request->localisation,
            'description' => $request->description,
            'bathrooms' => $request->bathrooms,
            'area' => $request->area,
            'model' => $request->model,
            'category' => $request->id_category,
            'price' => $request->price,
            'quartier'=>$request->quartier,
            'position'=>$request->position
        ];

        if ($request->hasFile('path')) {
            $imagePath = $request->file('path')->store('images', 'public');
            $data['path'] = $imagePath;
        } else {
            $data['path'] = 'default.jpg';
        }
        homes::find($id)->update($data);
        return redirect()->route('homes');
    }

    public function delete($id)
    {
        homes::find($id)->delete();
        return redirect()->route('homes');
    }

    public function getHomeCount()
    {
        $HomeCount = homes::count();
        return $HomeCount;
    }

    public function shows($id)
    {
        $house = homes::find($id);

        if (!$house) {
            return response()->json(['error' => 'House not found'], 404);
        }
        return response()->json($house);
    }

    public function search(Request $request)
    {
        $property = $request->input('property');
        $results = homes::where('price', $property)->get();

        if ($results->isEmpty()) {
            return response()->json(['error' => 'Aucune maison trouvée'], 404);
        }

        return response()->json($results);

    }



}
