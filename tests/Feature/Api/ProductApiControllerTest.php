<?php
namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Services\Transaction\PurchaseService;
use App\Http\Controllers\Api\ProductApiController;
use Mockery;
use Tests\SupportTraits\PurchaseMockTrait;

class ProductApiControllerTest extends TestCase
{

    use PurchaseMockTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockedPurchaseService = Mockery::mock(PurchaseService::class);
    }

    public function test_should_return_successful_response_on_successful_purchase()
    {
        $request = $this->createPurchaseRequest([
            ['id' => 1, 'quantity' => 2],
            ['id' => 2, 'quantity' => 1],
        ]);

        $mockedResponse = [
            'status' => 'success',
            'message' => 'Transaction completed successfully',
            'transaction' => 'transaction_id_123',
            'totalAmount' => 150.00
        ];

        $testResponse = $this->processPurchaseAndGetResponse($request, $mockedResponse,ProductApiController::class);

        $testResponse->assertStatus(200);
        $responseData = $testResponse->getData(true);
        $this->assertEquals('Transaction completed successfully', $responseData['message']);
        $this->assertEquals('transaction_id_123', $responseData['transaction']);
        $this->assertEquals(150.00, $responseData['totalAmount']);
    }

    public function test_should_return_error_response_on_failed_purchase()
    {
        $request = $this->createPurchaseRequest([
            ['id' => 1, 'quantity' => 2],
            ['id' => 2, 'quantity' => 1],
        ]);

        $mockedResponse = [
            'status' => 'error',
            'message' => 'Insufficient inventory',
            'code' => 400
        ];

        $testResponse = $this->processPurchaseAndGetResponse($request, $mockedResponse,ProductApiController::class);

        // Assert
        $testResponse->assertStatus(400);
        $responseData = $testResponse->getData(true);
        $this->assertEquals('Insufficient inventory', $responseData['error']);
    }
}
