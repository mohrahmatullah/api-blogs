<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Callback;

class CallbackController extends Controller
{
    public function show()
    {
        return Callback::select('success_url','cancel_url')->where('user_id',auth()->user()->id)->first();;
    }

    public function store(Request $request)
    {
        try {
            $post_check = Callback::where('user_id',auth()->user()->id)->first();
            if($post_check){

                return response()->json(['status' => 'false', 'message' => 'Limit created']);
            }
            else{
                $post = new Callback();

                $post->user_id              = auth()->user()->id;
                $post->success_url          = $request->success_url;
                $post->cancel_url           = $request->cancel_url;

                if ($post->save()) {
                    return response()->json(['status' => 'success', 'message' => 'Callback created successfully']);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $post = Callback::where('user_id',auth()->user()->id)->first();
            
            $post->success_url          = $request->success_url;
            $post->cancel_url           = $request->cancel_url;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Callback updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
