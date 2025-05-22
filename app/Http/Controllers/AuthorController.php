<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        if ($authors->isEmpty()) {
            return response()->json([
              "success"  => true,
              "message" => "Resources data not found!"
            ], 200);
        }

        return response()->json([
            "succes" => true,
            "message" => "Get All Resources",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request)
    {
        //validator
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:100',
           'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
           'bio' => 'required|string'

         ]);

        //cek validator eror
        if ($validator->fails()) {
            return response()->json([
            'success' => false,
            'message' => $validator->errors()
          ], 422);
        }
        //upluad image
        $image = $request->file('photo');
        $image ->store('authors', 'public');


        //insert data
        $authors = Author::create([
          'name' => $request->name,
          'photo' => $image->hashName(),
          'bio' => $request->bio


        ]);

        //response
        return response()->json([
          'success' => true,
          'message' => 'Resources added successfully!',
          'data' => $authors
      ], 201);
    }
    //show data
    public function show(string $id)
    {
        $authors = Author::find($id);

        if (!$authors) {
            return response()->json([
              'succes' => false,
              'message' => 'Resource not found'

            ], 404);
        }

        //response
        return response()->json([
          'success' => true,
          'message' => 'Get detail Resource',
          'data' => $authors
        ], 200);

    }
    //update data
    public function update(string $id, request $request)
    {
        //1.mencari data
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json([
              'success' => false,
              'message' => 'Resource not Found'
            ], 404);
        }
        //2.validator
        $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:100',
          'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
          'bio' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
            'succes' => false,
            'message' => $validator->errors()
      ], 422);
        }
        //3.siapkan data yang ingin di update
        $data = [
          'name' => $request->name,
          'photo' => $request->photo,
          'bio' => $request->bio
        ];

        //4.handle image (upluad & delete image)
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->store('authors', 'public');


            if ($authors->photo) {
                Storage::disk('public')->delete('authors/'. $authors->photo);
            }

            $data['photo'] = $image->hashName();
        }
        //5.update data baru ke database
        $authors->update($data);

        return response()->json([
          'success' => true,
          'message' => 'Resources updated Successfully!',
          'data' => $authors
        ], 200);
    }

    public function destroy(string $id)
    {
        $authors = Author::find($id);
        if (!$authors) {
            return response()->json([
              'success' => false,
              'message' => 'Resource not Found'
            ], 404);

        }
        if ($authors->photo) {
            //delete from storage
            Storage::disk('public')->delete('authors/'. $authors->photo);
        }
        $authors->delete();
        return response()->json([
          'success' => true,
          'message' => 'Delete resource successfully'
        ]);
    }

}
