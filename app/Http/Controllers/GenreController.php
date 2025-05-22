<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\json;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        if ($genres->isEmpty()) {
            return response()->json([
              "success"  => true,
              "message" => "Resources data not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resources",
            "data" => $genres
        ], 200);
    }

    public function store(Request $request)
    {
        //1.validator
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:100',
           'description' => 'required|string'

         ]);

        //2.cek validator eror
        if ($validator->fails()) {
            return response()->json([
            'success' => false,
            'message' => $validator->errors()
            ], 422);
        }

        //3.insert data
        $genres = Genre::create([
          'name' => $request->name,
          'description' => $request->description
        ]);

        //response insert data
        return response()->json([
          'success' => true,
          'message' => 'Resources added successfully!',
          'data' => $genres
        ], 201);

    }
    //5. show data
    public function show(string $id)
    {
        $genres = Genre::find($id);

        if (!$genres) {
            return response()->json([
              'succes' => false,
              'message' => 'Resource not found'

            ], 404);
        }
        //response show data
        return response()->json([
          'success' => true,
          'message' => 'Get detail Resource',
          'data' => $genres
        ], 200);

    }

    //update data
    public function update(string $id, request $request)
    {
        //1.mencari data
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json([
              'success' => false,
              'message' => 'Resource not Found'
            ], 404);
        }
        //2.validator
        $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:100',
         'description' => 'required|string'
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
          'description' => $request->description,
        ];

        //4.handle image (upluad & delete image)
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('genres', 'public');


            if ($genres->cover_photo) {
                Storage::disk('public')->delete('genres/'. $genres->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }
        //5.update data baru ke database
        $genres->update($data);

        return response()->json([
          'success' => true,
          'message' => 'Resources updated Successfully!',
          'data' => $genres
        ], 200);

    }

    //6. destroy data
    public function destroy(string $id)
    {
        $genres = Genre::find($id);
        if (!$genres) {
            return response()->json([
              'success' => false,
              'message' => 'Resource not Found'
            ], 404);

        }
        if ($genres->cover_photo) {
            //delete from storage
            Storage::disk('public')->delete('genres/'. $genres->cover_photo);
        }
        $genres->delete();
        //response destroy data
        return response()->json([
          'success' => true,
          'message' => 'Delete resource successfully'
        ]);
    }

}
