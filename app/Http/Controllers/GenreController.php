<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();

        if ($genres->isEmpty()){
            return response()->json([
              "success"  => true,
              "message" =>"Resources data not found!"
            ],200);
          }

        return response()->json([
            "success" => true,
            "message" =>"Get All Resources",
            "data" => $genres
        ],200);
    }

    public function store(Request $request){
        //1.validator
         $validator = Validator::make($request->all(), [
            'name'=> 'required|string|max:100',
            'description' => 'required|string'
           
          ]);
  
        //2.cek validator eror
          if ($validator->fails()){
              return response()->json([
              'success'=> false,
              'message'=> $validator->errors()
            ],422);
          }
  
        //3.insert data
          $genres = Genre::create([
            'name'=>$request->name,
            'description'=>$request->description
          ]);
  
        //4.response
           return response()->json([
             'success' => true,
             'message' =>'Resources added successfully!',
             'data' => $genres
        ], 201);
    }
  }
  















