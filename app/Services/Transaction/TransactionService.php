<?php

namespace App\Services\Transaction;

use App\Http\Requests\PurchaseRequest;
use App\Models\Transaction;

class TransactionService
{
    public function createTransaction(PurchaseRequest $request,$validResource)
    {
        $transaction = new Transaction();
        $transaction->address = $request->address;
        $transaction->city = $request->city;
        $transaction->state = $request->state;
        $transaction->phone_number = $request->phone_number;
        $transaction->user_id = auth()->id();
        $transaction->total_amount = $validResource['totalAmount'];
        $transaction->save();

        $this->transactionProduct($request->products,$transaction,$validResource['products']);

        return $transaction;
    }

    public function transactionProduct($products, $transaction, $resourceProducts)
    {
        foreach ($products as $product) {
            $resourceProduct = $resourceProducts->where('id', $product['id'])->first();
            $transaction->products()->attach($resourceProduct->id, [
                'quantity' => $product['quantity'],
                'price' => $resourceProduct->price
            ]);
        }
    }

}
