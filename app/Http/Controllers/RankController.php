<?php

namespace App\Http\Controllers;

use App\Models\God;
use App\Models\rank;
use App\Http\Requests\StorerankRequest;
use App\Http\Requests\UpdaterankRequest;
use Illuminate\Http\Request;

//one to one with god table
class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = rank::simplePaginate(5);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // get parent God table
    public function getAll(){
        $data = rank::with('getGods')->get();
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
        $data = God::find($id);

        // if parent id is not found
        if(!$data){
            return response()->json([
               'message' => 'Fail to create'
            ]);
        }else{ // if we found parent id
            $rankData = new rank();

            $rankData->power = $request->power;
            $rankData->godId = $id;

            if ($rankData->save()) {
                return response()->json(['message' => 'Rank created successfully']);
            } else {
                return response()->json(['message' => 'Failed to create rank']);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(rank $rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rank $rank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaterankRequest $request, rank $rank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rank $rank)
    {
        //
    }
}
