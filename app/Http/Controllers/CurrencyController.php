<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return Currency::orderBy('created_at', 'DESC')->get();
    }

    public function show($id)
    {
        return Currency::find($id);
    }

    public function store(Request $request)
    {
        try {
            $post = new Currency();
            $post->name        = $request->name;
            $post->abbreviation= $request->abbreviation;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Currency created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Currency::findOrFail($id);
            
            $post->name        = $request->name;
            $post->abbreviation= $request->abbreviation;

            if ($post->save()) {
                return response()->json(['status' => 'success', 'message' => 'Currency updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Currency::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Currency deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
