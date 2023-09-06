<?php

namespace App\Http\Controllers;

use App\Models\God;
use App\Http\Requests\StoreGodRequest;
use App\Http\Requests\UpdateGodRequest;
use Illuminate\Http\Request;

class GodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = God::simplePaginate(5); // get only God table data

        $data = God::with('getRank')->simplePaginate(5); // get GOD with their child

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // get all sub

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
        $data = new God();

        $data->name = $request->name;

        $data->save();

        if($data->save()){
            return[
                'data' => $data,
                'message' => 'successfully'
            ];
        }else{
            return[
              'message' => 'fail to create'
            ];
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(God $god)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = God::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function getSubWithId($id)
    {
        $data = God::find($id);
        $cate = $data->getRank;
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGodRequest $request, God $god)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(God $god)
    {
        //
    }
}
