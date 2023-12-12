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

        $validatedData=$request->validate([
            'name'=>'required|string|unique:categories,name',
            'description'=>'required|string',

        ]);

        $category=Category::create([
            'name'=>$validatedData['name'],
            'description'=>$validatedData['description'],

        ]);

        return response()->json(['message'=>'Category
        Addded Successfully','category'=>$category],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)

    {
        $category =Category::find($id);
        if($category){
            return response(['data'=>$category,'success'=>true],200);
        }else{
            return response(['data'=>$category,'success'=>false],404);
        }

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
    // public function update(Request $request, Category $category)
    // {
    //     $data=$request->only(['name','description']);
    //     $category->update($data);

    //     return response(['message'=>'Category Updated Successfully'],200);
    // }
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if($category){
            $category->name= $request->name;
            $category->description=$request->description;
            $category->save();
            return response(['data'=>$category,'success'=>true]);
        }else{
            return response(['data'=>$category,'success'=>false,'message'=>'Category not found'],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Category $category)
    // {
    //     $category->delete();
    //     return response(['message'=>'Category Deleted Successfully'],200);
    // }

    public function destory(string $id){
        $category=Category::find($id);
        //dd($category);
        if($category){

            $category->delete();
            return response(['message'=>'Category Deleted Successfully','success'=>true]);
        }
        else{
            return response(['message'=>'Category Deleted Fail','success'=>false],400);
        }
    }
}
