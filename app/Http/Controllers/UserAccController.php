<?php

namespace App\Http\Controllers;

use App\Models\UserAcc;
use App\Http\Requests\StoreUserAccRequest;
use App\Http\Requests\UpdateUserAccRequest;
use Illuminate\Http\Request;

class UserAccController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UserAcc::paginate(30);

        return $data;
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
        $request->validate([
            'Name' => 'required',
//            'UserTimePost' => 'required|date',
//            'UserProfile' => 'required|image',
        ]);

        $user = new UserAcc();
        $user->Name = $request->input('Name');
        $user->UserTimePost = $request->input('UserTimePost');
        $user->UserProfile = $request->file('UserProfile')->store('profiles');
        $user->UserPostImages = $request->file('UserPostImages')->store('images');
        if ($user->save()) {
            return [
                "error" => "0",
                "message" => "Create new user successfully",
            ];
        } else {
            return [
                'error' => '1',
                'message' => 'Fails to create new user ',
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = UserAcc::findOrFail($id);

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = UserAcc::findOrFail($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required',
            'UserTimePost' => 'required|date',
            'UserProfile' => 'required|image',
        ]);

        $user = UserAcc::findOrFail($id);
        $user->Name = $request->input('Name');
        $user->UserTimePost = $request->input('UserTimePost');
        if ($request->hasFile('UserProfile')) {
            $user->UserProfile = $request->file('UserProfile')->store('profiles');
        }
        if ($request->hasFile('UserPostImages')) {
            $user->UserPostImages = $request->file('UserPostImages')->store('images');
        }
        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = UserAcc::findOrFail($id);

        $data->delete();

        return response()->json([
            "message" => 'Deleted action is successfully',
        ]);
    }
}
