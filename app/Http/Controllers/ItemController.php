<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Mail\ItemMailCreated;
use Illuminate\Support\Facades\Mail;


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
        return response(['data' => $item], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|unique:items,name',
            'description' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',

        ]);

        $item = Item::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],

        ]);
        $itemcaty = [];
        $categories = $request->category_id;
        foreach ($categories as $category) {
            $itemcaty[] = [
                'item_id' => $item->id,
                'category_id' => $category,
            ];
        }
        if (count($itemcaty)) {
            ItemCategory::insert($itemcaty);
        }

        $toEmail =env('INVENTORY_ADMIN_EMAIL');
        try{
            Mail::to($toEmail)->send(new ItemMailCreated($item));
            $message ='Item created and Email sent successfully';
        }catch (\Exception $e) {
            $message = 'Item created But mail not sent, error: '.$e->getMessage();
        }

        return response()->json(['message' => 'Item
        Addded Successfully', 'Item' => $item], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response(['data' => $item], 200);
    }

    public function edit(Item $item)
    {
        return response(['data' => $item], 200);
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
        // print_r($request->all(), $id);
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',

        ]);
        $item->update($validatedData);
        $itemcaty = [];
        $categories = $request->category_id;
        foreach ($categories as $category) {
            $itemcaty[] = [
                'item_id' => $item->id,
                'category_id' => $category,
            ];
        }
        if (count($itemcaty)) {
            ItemCategory::where('item_id', $item->id)->delete();
            ItemCategory::insert($itemcaty);
        }
        return response()->json(['message' => 'Item Updated Successfully', 'data' => $item], 200);
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
        return response(['message' => 'Item Deleted Successfully'], 200);
    }
}
