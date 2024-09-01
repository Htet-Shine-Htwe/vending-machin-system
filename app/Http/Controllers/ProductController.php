<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\PurchaseRequest;
use App\Services\Product\ProductInventoryService;
use App\Services\Product\ProductService;
use App\Services\Transaction\PurchaseService;
use App\Services\Transaction\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {

    public function __construct( protected ProductService $productService , protected PurchaseService $purchaseService ) {

    }

    public function index( Request $request ) : View {
        $products = ($this->productService->getAll( $request ))
        ->paginate( $request->per_page ?? 4 )
        ->withQueryString();

        return view( 'portal.products.index', compact( 'products' ) );
    }

    public function create() : View {
        $editPage = false;
        return view( 'portal.products.action', compact( 'editPage' ) );
    }

    public function store( ProductStoreRequest $request ) : RedirectResponse {
        $product = $this->productService->create( $request );

        if ( !$product ) {
            return redirect()->route( 'products.index' )->with( 'error', 'Product could not be created' );
        }

        return redirect()->route( 'products.index' )->with( 'success', 'Product created successfully' );
    }

    public function edit( Request $request ) : View | RedirectResponse {
        $product = $this->productService->getBySlug( $request->slug );
        $editPage = true;

        if ( !$product ) {
            return redirect()->route( 'products.index' )->with( 'error', 'Product not found' );
        }

        return view( 'portal.products.action', compact( 'product', 'editPage' ) );
    }

    public function update( ProductUpdateRequest $request ) : RedirectResponse {

        try {
            $this->productService->update( $request );

            return redirect()->back()->with( 'success', 'Product updated successfully' );

        } catch( \Exception $e ) {
            return redirect()->route( 'products.index' )->with( 'error', $e->getMessage() );
        }

    }

    public function delete(string $slug ) : RedirectResponse
    {
        try {
            $this->productService->delete( $slug );

            return redirect()->route( 'products.index' )->with( 'success', 'Product Removed successfully' );

        } catch( \Exception $e ) {
            return redirect()->route( 'products.index' )->with( 'error', $e->getMessage() );
        }
    }

    public function processPurchase(PurchaseRequest $request): JsonResponse
    {
        $result = $this->purchaseService->processPurchase($request);

        if ($result['status'] === 'success') {
            return response()->json(['message' => $result['message']], 200);
        }

        return response()->json(['error' => $result['message']], $result['code']);
    }
}
