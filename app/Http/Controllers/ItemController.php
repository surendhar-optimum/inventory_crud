<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Category;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use App\Mail\ItemMailCreated;
use App\Mail\ItemMailDeleted;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item = Item::with(['category.itemcat'])->get();
        return response(['data' => $item,'success'=>true], 200);
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
            'price' => 'required|integer|gte:0',
            'quantity' => 'required|integer|gte:0',
            'category_id'=>'required|array|min:1'

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
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ];
        }
        if (count($itemcaty)) {
            ItemCategory::insert($itemcaty);
        }

        $toEmail =env('INVENTORY_ADMIN_EMAIL');
        try{
            Mail::to($toEmail)->send(new ItemMailCreated($item));
            $message ='Item created and Email sent successfully';
            unset($item->$itemcaty);
        }catch (\Exception $e) {
            $message = 'Item created But mail not sent, error: '.$e->getMessage();
        }
        unset($item->$itemcaty);
        return response()->json(['message' => 'Item
        Addded Successfully', 'Item' => $item], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $item= Item::with(['category'])->find($id);
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
    public function update(Request $request, string $id)
    {
        // print_r($request->all(), $id);
        $item = Item::find($id);
        if(!$item){

            return response()->json(['data' => $item,
            'success' => false,'message'=>'Item not found',
            ],404);

        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer|gte:0',
            'quantity' => 'required|integer|gte:0',

        ]);
        $item->update($validatedData);

        ItemCategory::where('item_id',$item->id)->delete();
        $itemcaty = [];
        $categories = $request->category_id;
        foreach ($categories as $category) {
            $itemcaty[] = [
                'item_id' => $item->id,
                'category_id' => $category,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),

            ];
        }
        if (count($itemcaty)) {
            ItemCategory::where('item_id', $item->id)->delete();
            ItemCategory::insert($itemcaty);
        }
        $toEmail =env('INVENTORY_ADMIN_EMAIL');
        $ccUsers =explode(',',env('INVENTORY_TEAM_MAILS'));
        try{
            $item->is_created=false;
            Mail::to($toEmail)->cc($ccUsers)->send(new ItemMailCreated($item));
            $message ='Item updated and Email sent successfully';
            unset($item->is_created);
        }catch (\Exception $e) {
            $message = 'Item updated But mail not sent, error: '.$e->getMessage();
        }
        unset($item->is_created);
        return response()->json(['message' => 'Item Updated Successfully', 'data' => $item], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if($item){
        $itemDetails =$item;
        $item->delete();

        $toEmail =env('INVENTORY_ADMIN_EMAIL');
        $ccUsers =explode(',',env('INVENTORY_TEAM_MAILS'));
        try{

            Mail::to($toEmail)->cc($ccUsers)->send(new ItemMailDeleted($item));
            $message ='Item deleted and Email sent successfully';
        }catch (\Exception $e) {
            $message = 'Item deleted But mail not sent, error: '.$e->getMessage();
        }
        return response()->json(['message' => 'Item Deleted Successfully', 'success'=>true]);
    }else{
        return response()->json(['message' => 'Item Deleted Failed', 'success'=>false],400);


        }



    }
}
