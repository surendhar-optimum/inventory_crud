<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fruit;
use Illuminate\Support\Facades\Response;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fruits=Fruit::get();
        return response()->json($fruits);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {


    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $fruit = new Fruit;
       $fruit->name=$request->name;
       $fruit->description=$request->description;
       $fruit->price=$request->price;
       $fruit->quantity=$request->quantity;
       $fruit->save();
       return Response::json([
        'data'=>$fruit,
        'success'=>true
       ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $fruit = Fruit::find($id);
        if($fruit){
            return Response::json([
                'data'=>$fruit,
                'success'=>true
            ],200);
        }
        else {
            return Response::json([
                'data'=>$fruit,
                'success'=>false,
                'message'=>'Fruit not found'
            ],401);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $fruit=Fruit::find($id);
        if($fruit){
            $fruit->name=$request->name;
            $fruit->description=$request->description;
            $fruit->price=$request->price;
            $fruit->quantity=$request->quantity;
            $fruit->save();
            return Response::json([
                'data'=>$fruit,
                'success'=>true
            ]);
        }
        else
        {
            return Response::json([
            'data'=>$fruit,
            'success'=>false,
            'message'=>'Fruit not found'
        ],404);

    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $fruit=Fruit::find($id);
        if($fruit){
            $fruit->delete();
            return Response::json([

                'success'=>true,
                'message'=>'Fruit Deleted successfully'
            ]);
    } else
    {
        return Response::json([
        'success'=>false,
        'message'=>'Fruit not deleted'
    ],400);
}
    }
}
