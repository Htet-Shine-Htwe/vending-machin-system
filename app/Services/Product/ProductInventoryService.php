<?php

namespace App\Services\Product;

use App\Exceptions\ProductInvalidException;
use App\Models\Product;

class ProductInventoryService
{


    public function __construct(protected $requestProducts){

    }

    public function validResource() : array
    {
        $productIds = collect($this->requestProducts)->pluck('id');

        $resourceProducts = Product::whereIn('id', $productIds)->get();

        foreach ($this->requestProducts as $requestProduct) {
            $product = $resourceProducts->where('id', $requestProduct['id'])->first();

            if (!$product) {
                throw new ProductInvalidException('Product not found',404);
            }

            if ($product->quantity_available < $requestProduct['quantity']) {
                throw new ProductInvalidException(
                    "Product {$product->name} is not available in the requested quantity "
                , 400);
            }
        }

        $totalAmount = collect($this->requestProducts)->sum(function ($requestProduct) use ($resourceProducts) {
            $product = $resourceProducts->where('id', $requestProduct['id'])->first();
            return $product->price * $requestProduct['quantity'];
        });

        return [
            'products' => $resourceProducts,
            'totalAmount' => $totalAmount
        ];
    }



    public function updateInventory($products)
    {
        foreach ($this->requestProducts as $requestProduct) {
            $product = $products->where('id', $requestProduct['id'])->first();
            $product->quantity_available -= $requestProduct['quantity'];
            $product->save();
        }
    }
}
