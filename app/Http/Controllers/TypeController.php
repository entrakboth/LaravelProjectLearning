<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Type::simplePaginate(5);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return api don't have to use this action
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required|min:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new Type();
        $data->Title = $request->input('Title');

        if ($request->hasFile('Image')) {
            $image = $request->file('Image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/image', $imageName); // Store the image in the "public/image" directory
            $data->Image = asset('storage/image/' . $imageName);
        }

        if ($data->save()) {
            return [
                'Error' => '0',
                'Status' => 'success'
            ];
        } else {
            return [
                'Error' => '1',
                'Status' => 'Fail to store'
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Type::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Title' => 'required|min:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Type::findOrFail($id);
        $data->Title = $request->input('Title');

        if ($request->hasFile('Image')) {
            $image = $request->file('Image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/image', $imageName); // Store the new image in the "public/images" directory
            $data->Image = asset('storage/image/' . $imageName); // Generate the URL for the new image
        }

        $data->save();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Type::findOrFail($id);

        $data->delete();

        return response()->json([
            'status' => 'delete success'
        ]);
    }
}
