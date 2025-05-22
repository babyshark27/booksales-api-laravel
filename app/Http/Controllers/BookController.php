<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        if ($books->isEmpty()) {
            return response()->json([
              "succes"  => true,
              "message" => "Resources data not found!"
            ], 200);
        }


        return response()->json([
          "succes" => true,
          "message" => "Get all Resources",
          "data"   => $books

        ]);
    }
    public function store(Request $request)
    {
        //1.validator
        $validator = Validator::make($request->all(), [
           'title' => 'required|string|max:100',
           'description' => 'required|string',
           'price' => 'required|numeric',
           'stock' => 'required|integer',
           'cover_photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
           'genre_id' => 'required|exists:genres,id',
           'author_id' => 'required|exists:authors,id'
         ]);

        //2.cek validator eror
        if ($validator->fails()) {
            return response()->json([
            'succes' => false,
            'message' => $validator->errors()
          ], 422);
        }

        //3.upluad image
        $image = $request->file('cover_photo');
        $image ->store('books', 'public');

        //4.insert data
        $book = Book::create([
          'title' => $request->title,
          'description' => $request->description,
          'price' => $request->price,
          'stock' => $request->stock,
          'cover_photo' => $image->hashName(),
          'genre_id' => $request->genre_id,
          'author_id' => $request->author_id
        ]);

        //response insert data
        return response()->json([
          'success' => true,
          'message' => 'Resources added successfully!',
          'data' => $book
      ], 201);
    }
    //6.show data
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
              'succes' => false,
              'message' => 'Resource not found'

            ], 404);
        }

        //response show data
        return response()->json([
          'success' => true,
          'message' => 'Get detail Resource',
          'data' => $book
        ], 200);
    }

    //update data
    public function update(string $id, request $request)
    {
        //1.mencari data
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
              'success' => false,
              'message' => 'Resource not Found'
            ], 404);
        }

        //2.validator
        $validator = Validator::make($request->all(), [
          'title' => 'required|string|max:100',
          'description' => 'required|string',
          'price' => 'required|numeric',
          'stock' => 'required|integer',
          'cover_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
          'genre_id' => 'required|exists:genres,id',
          'author_id' => 'required|exists:authors,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
            'succes' => false,
            'message' => $validator->errors()
      ], 422);
        }
        //3.siapkan data yang ingin di update
        $data = [
          'title' => $request->title,
          'description' => $request->description,
          'price' => $request->price,
          'stock' => $request->stock,
          'genre_id' => $request->genre_id,
          'author_id' => $request->author_id,
        ];

        //4.handle image (upluad & delete image)
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');


            if ($book->cover_photo) {
                Storage::disk('public')->delete('books/'. $book->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }
        //5.update data baru ke database
        $book->update($data);

        return response()->json([
          'success' => true,
          'message' => 'Resources updated Successfully!',
          'data' => $book
        ], 200);

    }
    //7.destroy data
    public function destroy(string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
              'success' => false,
              'message' => 'Resource not Found'
            ], 404);
        }
        //destroy image/file
        if ($book->cover_photo) {
            //delete from storage
            Storage::disk('public')->delete('books/'. $book->cover_photo);
        }
        $book->delete();
        //response destroy data
        return response()->json([
          'success' => true,
          'message' => 'Delete resource successfully'
        ]);
    }

}
