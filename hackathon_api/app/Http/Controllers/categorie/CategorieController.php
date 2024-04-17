<?php

namespace App\Http\Controllers\categorie;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategorieRequest;

class CategorieController extends Controller
{
    public function store(CategorieRequest $categorieRequest)
    {
        if (Auth::User()->role == "admin") {
            $categorieData = $categorieRequest->validated();
            $categories = Categorie::create($categorieData);

            $response = [
                'categories' => $categories,
                'message' => 'Categorie created successfully'
            ];

            return response()->json($response, 201);
        } else {
            return response()->json(" Unauthorized
      ",401);
        }
    }
    public function update(CategorieRequest $categorieRequest, Categorie $categorie)
    {
        if (Auth::User()->role == "admin") {
            $categorieData = $categorieRequest->validated();
            $categorie = Categorie::findOrFail($categorie->id);
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
    public function index()
    {
        if (Auth::User()->role == "admin") {
            $categories = Categorie::all();

            $response = [
                'categories' => $categories,
                'message' => 'Categorie DATA successfully'
            ];
            return response()->json($response, 200);
        }   else{
            return response()->json(" Unauthorized
            ",401);        }
    }

    public function destroy(Categorie $categorie)
    {
        if (Auth::User()->role == "admin") {
            $categorie = Categorie::findOrFail($categorie->id);
            $categorie->delete();
            $response = [

                'message' => 'Categorie Deltete successfully'
            ];
            return response()->json($response, 200);

        }   else{
            return response()->json(" Unauthorized
            ",401);        }


    }
    public function show(Categorie $categorie)
    {
        if (Auth::User()->role == "admin") {
            $categories = Categorie::findOrFail($categorie->id);

            $response = [
                'categories'=>$categories,

            ];
            return response()->json($response, 200);

        }   else{
            abort(401);
        }


    }
}