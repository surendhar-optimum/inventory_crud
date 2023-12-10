<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response(['data'=>$category],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // Category::create($data);
        // return response(['message'=>'Category Created successfully'],200);
        $validatedData=$request->validate([
            'name'=>'required|string|unique:categories,name',
            'description'=>'required|string',
            'price'=>'required|integer',
            'quantity'=>'required|integer',
        ]);

        $category=Category::create([
            'name'=>$validatedData['name'],
            'description'=>$validatedData['description'],
            'price'=>$validatedData['price'],
            'quantity'=>$validatedData['quantity'],
        ]);

        $item=Item::create([
            'category_id'=>$category->id,
            'name'=>$validatedData['name'],
            'description'=>$validatedData['description'],]);

        return response()->json(['message'=>'Category
        Addded Successfully','category'=>$category,'item'=>$item],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response(['data'=>$category],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response(['data'=>$category],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data=$request->only(['name','description','price','quantity']);
        $category->update($data);
        return response(['message'=>'Category Updated Successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(['message'=>'Category Deleted Successfully'],200);
    }
}
