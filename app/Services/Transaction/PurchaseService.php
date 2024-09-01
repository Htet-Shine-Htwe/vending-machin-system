<?php
namespace App\Services\Transaction;


use App\Http\Requests\PurchaseRequest;
use App\Services\Product\ProductInventoryService;
use App\Services\Transaction\TransactionService;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function processPurchase(PurchaseRequest $request): array
    {
        DB::beginTransaction();
        try {
            $validOrderedProducts = new ProductInventoryService($request->products);

            $validResources = $validOrderedProducts->validResource();

            $transition = $this->transactionService->createTransaction($request, $validResources);

            $validOrderedProducts->updateInventory($validResources['products']);

            DB::commit();

            return ['status' => 'success', 'message' => 'Transaction completed successfully',
                'transaction' => $transition, 'totalAmount' => $validResources['totalAmount']
        ];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage(), 'code' => $e->getCode() ?? 500];
        }
    }
}
