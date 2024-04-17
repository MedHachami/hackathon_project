<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel as Category;
use Illuminate\Support\Facades\Cache;


class CategoryController extends Controller
{
    public function index()
    {
        // $cacheKey = '$categories';
        // if (Cache::has($cacheKey)) {
            // $categories = Cache::get($cacheKey);
        // } else {
            $categories = Category::all();

            

        //     Cache::put($cacheKey, $categories, now()->addMinutes(30));
        // }
        
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
