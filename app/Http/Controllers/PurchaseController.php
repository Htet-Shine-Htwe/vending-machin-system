<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct( protected ProductService $productService ) {
    }


    public function index(Request $request )
    {
        $products = ($this->productService->getAll( $request ))
        ->paginate( $request->per_page ?? 20 )
        ->withQueryString();

        return view('user.purchase.index',compact('products'));
    }
}
