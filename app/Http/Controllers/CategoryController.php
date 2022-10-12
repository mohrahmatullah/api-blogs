<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::orderBy('created_at', 'DESC')->get();
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function store(Request $request)
    {
        try {
            $post = new Category();
            $post->title        = $request->title;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Category created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Category::findOrFail($id);
            
            $post->title        = $request->title;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Category updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Category::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
