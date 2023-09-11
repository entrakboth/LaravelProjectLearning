<?php

namespace App\Http\Controllers;

use App\Models\cities;
use App\Models\kingdom;
use App\Http\Requests\StorekingdomRequest;
use App\Http\Requests\UpdatekingdomRequest;
use Illuminate\Http\Request;

class KingdomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // get all kingdoms data
    public function index()
    {
        $data = kingdom::simplePaginate(5);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // Get all kingdoms data with their relationship
    public function getCities(){
        $data = kingdom::with('getCities')->simplePaginate(5);

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
    public function store(Request $request)
    {
        $data = new kingdom();

        $data->Title = $request->Title;
        $data->Power = $request->Power;

        if($data->save()){
            return response()->json([ 'status' => 'success to save',]);
        }else{
            return response()->json([ 'status' => 'Fail to save',]);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(kingdom $kingdom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = kingdom::find($id);
        $citiesData = $data->getCities;

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekingdomRequest $request, kingdom $kingdom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = kingdom::findOrFail($id);

        $cityData = $data->getCities;

        if($data->delete()){
            if($cityData){
                foreach ($cityData as $city) {
                    $city->delete();
                }
            }
            return response()->json([ 'status' => 'success to delete',]);
        }else{
            return response()->json([ 'status' => 'Fail to delete',]);

        }
    }
}
