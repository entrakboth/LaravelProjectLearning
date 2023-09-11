<?php

namespace App\Http\Controllers;

use App\Models\cities;
use App\Http\Requests\StorecitiesRequest;
use App\Http\Requests\UpdatecitiesRequest;
use App\Models\kingdom;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = cities::simplePaginate(5);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getKingdoms(){
        $data = cities::with('getKingdoms')->simplePaginate(5);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $data = kingdom::find($id);

        if(!$data){
            return response()->json([
                'message' => 'Fail to create'
            ]);
        }else{
            $cityData = new cities();

            $cityData->KingdomsId = $id;
            $cityData->Name = $request->Name;

            if($cityData->save()){
                return response()->json([ 'status' => 'success to save',]);
            }else{
                return response()->json([ 'status' => 'Fail to save',]);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(cities $cities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cities $cities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecitiesRequest $request, cities $cities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cities $cities)
    {
        //
    }
}
