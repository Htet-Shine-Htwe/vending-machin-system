<?php

namespace App\Services\Product;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductService {

    public function getBySlug( $slug )   : Product | null {
        return Product::where( 'slug', $slug )->first();
    }

    public function getAll( Request $request )  {
        return Product::
        filter( $request->all() )
        ->latest()
        ->paginate( $request->per_page ?? 10 )
        ->withQueryString();
    }

    public function create( ProductStoreRequest $request ) : Product {
        return Product::create( $request->validated() );
    }

    public function update( ProductUpdateRequest $request ) : bool | null {
        $product = $this->getBySlug( $request->slug );
        if ( !$product ) {
            throw new \Exception( 'Product not found' );
        }

        return $product->update( $request->validated() );
    }

    public function delete( $slug ) : bool {
        $product = $this->getBySlug( $slug );
        if ( !$product ) {
            throw new \Exception( 'Product not found' );
        }

        return $product->delete();
    }
}
