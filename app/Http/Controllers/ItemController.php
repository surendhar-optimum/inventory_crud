<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        return response(['data'=>$item],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data=$request->only(['name','description','price','quantity']);
        // Item::create($data);
        // return response(['message'=>'Item Created successfully'],200);
        $validatedData=$request->validate([
            'name'=>'required|string|unique:items,name',
            'description'=>'required|string',
            'price'=>'required|integer',
            'quantity'=>'required|integer',
            'category_id'=>'required|integer',
        ]);

        $item=Item::create([
            'name'=>$validatedData['name'],
            'description'=>$validatedData['description'],
            'price'=>$validatedData['price'],
            'quantity'=>$validatedData['quantity'],
            'category_id'=>$validatedData['category_id'],

        ]);


        return response()->json(['message'=>'Item
        Addded Successfully','Item'=>$item],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response(['data'=>$item],200);
    }

    public function edit(Item $item)
    {
        return response(['data'=>$item],200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item=Item::findOrFail($id);

        $validatedData=$request->validate([
            'name'=>'required|string|unique:items,name',
            'description'=>'required|string',
            'price'=>'required|integer',
            'quantity'=>'required|integer',
            'category_id'=>'required|integer',
        ]);
        $item->update($validatedData);
        return response()->json(['message'=>'Item Updated Successfully','data'=>$item],200);





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response(['message'=>'Item Deleted Successfully'],200);
    }
}
