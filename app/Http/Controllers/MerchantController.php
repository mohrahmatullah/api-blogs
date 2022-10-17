<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function index()
    {
        return Merchant::select('id','name_merchant','chanel')->orderBy('created_at', 'DESC')->get();
    }

    public function show($id)
    {
        return Merchant::find($id);
    }

    public function store(Request $request)
    {
        try {
            $post = new Merchant();
            $post->name_merchant        = $request->name_merchant;
            $post->chanel               = $request->chanel;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Merchant created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Merchant::findOrFail($id);
            
            $post->name_merchant        = $request->name_merchant;
            $post->chanel               = $request->chanel;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Merchant updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Merchant::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Merchant deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
