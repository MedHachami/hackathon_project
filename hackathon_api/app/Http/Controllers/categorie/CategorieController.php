<?php

namespace App\Http\Controllers\categorie;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategorieRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


class CategorieController extends Controller
{
    public function store(CategorieRequest $categorieRequest)
    {
        if (Auth::User()->role == "admin") {
            $categorieData = $categorieRequest->validated();
            $categories = Category::create($categorieData);

            $response = [
                'categories' => $categories,
                'message' => 'Categorie created successfully'
            ];

            return response()->json($response, 201);
        } else {
            return response()->json(" Unauthorized
      ", 401);
        }
    }
    public function update(Category $category , Request $request)
    {
        $user = JWTAuth::user();
        $user = auth()->user(); 
        if (!$user) {
            return response()->json("Unauthorized", 401);
        }else{
            if ($user->role == "admin") {
                $categorieData = $request->validate([
                    'name'=>'required|string',
                ]);
                $categorie = Category::findOrFail($category->id);
                $categorie->update($categorieData);
    
                $response = [
                    'categorie' => $categorie,
                    'message' => 'Categorie updated successfully'
                ];
                return response()->json($response, 200);
            } else {
                return response()->json(" Unauthorized
                ",401);        }
        }
        

    }
    public function index()
    {
        
            $categories = Category::all();

            $response = [
                'categories' => $categories,
                'message' => 'Categorie DATA successfully'
            ];
            return response()->json($response, 200);
    }

    public function destroy($id)
    {
        if (Auth::User()->role == "admin") {
            $categorie = Category::findOrFail($id);
            $categorie->delete();
            $response = [

                'message' => 'Categorie Deltete successfully'
            ];
            return response()->json($response, 200);

        } else {
            return response()->json(" Unauthorized
            ", 401);
        }


    }
    public function show($id)
    {
        if (Auth::User()->role == "admin") {
            $categories = Category::findOrFail($id);

            $response = [
                'categories' => $categories,

            ];
            return response()->json($response, 200);

        } else {
            abort(401);
        }


    }
}