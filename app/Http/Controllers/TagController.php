<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function store(Request $request)
    {
        try {
            $post = new Tag();
            $post->title        = $request->title;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Tag created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Tag::findOrFail($id);
            
            $post->title        = $request->title;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Tag updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Tag::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Tag deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
