<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Http\Requests\StorecountryRequest;
use App\Http\Requests\UpdatecountryRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Country::simplePaginate(5);

        return response()->json([
            'data' => $data,
            'message' => "Successfully"
        ]);
    }

    // get just cambodia and their state
    public function getCambodiaState(Request $request){

        $country = $request->Name;
        $data = Country::where('name', $country)->with("data")->get();
        return response()->json([
            'data' => $data,
            'message' => "Successfully"
        ]);
    }

    // get all state base on country id
    public function getStateById($id){
        $country = Country::find($id);

        if ($country) {
            $states = $country->data;

            return response()->json([
                'data' => $states,
                'message' => 'States retrieved successfully.'
            ]);
        } else {
            return response()->json([
                'message' => 'Country not found.'
            ], 404);
        }

    }

    public function GetState(){
        $data = Country::with("getOwnStates")->simplePaginate(5);

        return response()->json([
            'data' => $data,
            'message' => "Successfully"
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecountryRequest $request, country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(country $country)
    {
        //
    }
}
