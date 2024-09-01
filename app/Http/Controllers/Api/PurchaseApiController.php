<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class PurchaseApiController extends Controller
{
    public function __construct( protected ProductService $productService ) {
    }

    public function index(Request $request )
    {
        $products = ($this->productService->getAll( $request ))
        ->paginate( $request->per_page ?? 20 )
        ->withQueryString();

        return response()->json([
            'status' => 'success',
            'message' => 'Purchase list',
            'data' => $products,
        ]);
    }
}
