<?php

namespace App\Http\Controllers;

use App\Models\state;
use App\Http\Requests\StorestateRequest;
use App\Http\Requests\UpdatestateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = State::simplePaginate(5);

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
    public function store(StorestateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(state $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(state $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestateRequest $request, state $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(state $state)
    {
        //
    }
}
