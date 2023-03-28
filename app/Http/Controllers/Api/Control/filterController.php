<?php

namespace App\Http\Controllers\Api\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class FilterController extends Controller
{
    public function filter(Request $request){
        $Product_query = Product::with(['category']);

        if ($request->category) {
            $Product_query->whereHas('category', function($Products) use($request){
                $Products->where('name', $request->category);
            });
        }
    
        $Products = $Product_query->get();
        return response()->json([
            'data'=>$Products,
        ], 200);
    }
}
