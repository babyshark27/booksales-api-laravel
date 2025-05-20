<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();

        if ($books->isEmpty()){
        return response()->json([
          "succes"  =>true,
          "message" =>"Resources data not found!"
        ],200);
      }


        return response()->json([
          "succes" => true,
          "message"=> "Get all Resources",
          "data"   => $books 

        ]);
    }
    public function store(Request $request){
      //1.validator
       $validator = Validator::make($request->all(), [
          'title'=> 'required|string|max:100',
          'description' => 'required|string',
          'price' => 'required|numeric',
          'stock' => 'required|integer',
          'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
          'genre_id' => 'required|exists:genres,id',
          'author_id' => 'required|exists:authors,id'
        ]);

      //2.cek validator eror
        if ($validator->fails()){
            return response()->json([
            'succes'=> false,
            'message'=> $validator->errors()
          ],422);
        }

      //3.upluad image
        $image = $request->file('cover_photo');
        $image ->store('books','public');

      //4.insert data
        $book = Book::create([
          'title'=>$request->title,
          'description'=>$request->description,
          'price'=>$request->price,
          'stock'=>$request->stock,
          'cover_photo'=>$image->hashName(),
          'genre_id'=>$request->genre_id,
          'author_id'=>$request->author_id
        ]);

      //5.response
         return response()->json([
           'success' =>true,
           'message' =>'Resources added successfully!',
           'data' => $book
      ], 201);
    }
}
