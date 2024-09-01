<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Services\Product\ProductInventoryService;
use App\Services\Transaction\PurchaseService;
use App\Services\Transaction\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductApiController extends Controller {
    public function __construct( protected PurchaseService $purchaseService ) {

    }

    public function processPurchase( PurchaseRequest $request ): JsonResponse {
        $result = $this->purchaseService->processPurchase( $request );

        if ( $result[ 'status' ] === 'success' ) {
            return response()->json(
                [
                    'message' => $result[ 'message' ],
                    'transaction' => $result[ 'transaction' ],
                    'totalAmount' => $result[ 'totalAmount' ]
                ], 200 );
            }

            return response()->json( [ 'error' => $result[ 'message' ] ], $result[ 'code' ] );
        }
    }
