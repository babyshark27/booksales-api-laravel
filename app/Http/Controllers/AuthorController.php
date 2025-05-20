<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class AuthorController extends Controller
{
    public function index () {
      $authors = Author::all();

      if ($authors->isEmpty()){
        return response()->json([
          "success"  =>true,
          "message" =>"Resources data not found!"
        ],200);
      }

      return response()->json([
          "succes" => true,
          "message"=> "Get All Resources",
          "data" => $authors
      ],200);
    }

    public function store(Request $request){
      //1.validator
       $validator = Validator::make($request->all(), [
          'name'=> 'required|string|max:100',
          'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
          'bio' => 'required|string'
         
        ]);

      //2.cek validator eror
        if ($validator->fails()){
            return response()->json([
            'success'=> false,
            'message'=> $validator->errors()
          ],422);
        }
//3.upluad image
            $image = $request->file('photo');
            $image ->store('authors','public');


      //5.insert data
        $authors = Author::create([
          'name'=>$request->name,
          'photo'=>$image->hashName(),
          'bio'=>$request->bio
        

        ]);

      //6.response
         return response()->json([
           'success' => true,
           'message' =>'Resources added successfully!',
           'data' => $authors
      ], 201);
  }
}
