<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index( $id )
    {
        if($id == 'all'){
            return Post::with('category')->orderBy('created_at', 'DESC')->get();
        }
        else{
            return Post::where('category_id', $id)->with('category')->orderBy('created_at', 'DESC')->get();
        }
    }

    public function show($id)
    {
        return Post::with('category')->find($id);
    }

}
