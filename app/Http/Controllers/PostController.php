<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('category')->get();
    }

    public function show($id)
    {
        return Post::find($id);
    }

    public function store(Request $request)
    {
        try {
            $post = new Post();
            $post->title        = $request->title;
            $post->body         = $request->body;
            $post->category_id  = $request->category_id;
            $post->tag_id       = json_encode($request->tag_id);
            $post->status       = $request->status;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Post created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            
            $post->title        = $request->title;
            $post->body         = $request->body;
            $post->category_id  = $request->category_id;
            $post->tag_id       = json_encode($request->tag_id);
            $post->status       = $request->status;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Post updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Post deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
