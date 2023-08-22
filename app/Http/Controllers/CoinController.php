<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Power;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CoinController extends Controller
{
    // this line of code used to apply all middleware to all action in controller
    // it's mean all request should be authorization validate.
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coins = Coin::simplePaginate(5);
        return response()->json([
            'status' => 'success',
            'data' => $coins,

        ]);
    }

    public function get_all_subs()
    {
        //$coinsWithSubCategories = Coin::with('getall')->simplePaginate(5);
        $coinsWithSubCategories = Coin::with('getall')->simplePaginate(5);

        return response()->json([
            'status' => 'success',
            'data' => $coinsWithSubCategories,
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
        $request->validate([
            'Title' => 'required|min:1',
            'Qty' => 'required',
            'Prices' => 'required|min:1',
        ]);

        $coin = Coin::create([
            'Title' => $request->Title,
            'Qty' => $request->Qty,
            'Prices' => $request->Prices,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $coin,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Coin::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * one-to-one relationship
     */
    public function edit($id)
    {
        $data = Coin::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);

    }

    // one-to-many Coin table as parents
    public function sub_category($id)
    {
        // getAllSubCategories
        // find id on coin table and get all type in category
        $data = Coin::findOrFail($id);
        $cate = $data->getall;
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
        try {
            $request->validate([
                'Title' => 'required|min:1',
                'Qty' => 'required',
                'Prices' => 'required|min:1',
            ]);

            $coins = Coin::findOrFail($id);
            $coins->Title = $request->input('Title');
            $coins->Qty = $request->input('Qty');
            $coins->Prices = $request->input('Prices');
            $coins->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Todo updated successfully',
                'todo' => $coins,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coin not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coin = Coin::findOrFail($id);

        $coin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'delete, success',
        ], 200);
    }

    // search by type name
    public function searchByName(Request $request)
    {
        $name = $request->Title;

        // none using query builder in Laravel
        // normal search
        $result = Coin::where('Title', 'LIKE', '%' . $name . '%')->get();

        // search and sort by Qty
        // $result = Coin::where('Title' , 'LIKE' , '%' . $name . '%')->orderBy('Qty', 'desc')->get();

        if ($result->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No results found.'
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        }
    }

//$result = DB::table('coins')
//->select('*')
//->where('Title', 'LIKE', '%' . $name . '%')
//->orderBy('id', 'desc')
//->get();

    public function querySearch(Request $request)
    {
        $name = $request->Title;

        $result = DB::table('coins')
                    ->select('*')
                    ->where('Title','LIKE','%'. $name.'%')
                    ->orderBy('Qty', 'desc')->get();

        if ($result->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No results found.'
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        }
    }


}
