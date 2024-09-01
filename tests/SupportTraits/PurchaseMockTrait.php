<?php

namespace Tests\SupportTraits;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Testing\TestResponse;
use Mockery\MockInterface;

trait PurchaseMockTrait {
    /**
    * Mocked PurchaseService instance.
    *
    * @var MockInterface
    */
    protected MockInterface $mockedPurchaseService;

    /**
    * Create a purchase request.
    *
    * @param array $products
    * @return PurchaseRequest
    */
    protected function createPurchaseRequest( array $products ): PurchaseRequest {
        return new PurchaseRequest( [ 'products' => $products ] );
    }

    /**
    * Process the purchase and return the test response.
    *
    * @param PurchaseRequest $request
    * @param array $mockedResponse
    * @param string $controllerClass
    * @return TestResponse
    */
    protected function processPurchaseAndGetResponse(
        PurchaseRequest $request,
        array $mockedResponse,
        string $controllerClass
    ): TestResponse {
        if ( !isset( $this->mockedPurchaseService ) ) {
            throw new \RuntimeException( 'PurchaseService mock is not initialized.' );
        }

        $this->mockedPurchaseService
        ->shouldReceive( 'processPurchase' )
        ->once()
        ->with( $request )
        ->andReturn( $mockedResponse );

        $controller = new $controllerClass( $this->mockedPurchaseService );

        $response = $controller->processPurchase( $request );

        return TestResponse::fromBaseResponse( $response );
    }

    /**
     * Process the purchase and return the test response.
     *
     * @param PurchaseRequest $request
     * @param array $mockedResponse
     * @param string $controllerClass
     * @return TestResponse
     */
    protected function processRawPurchaseAndGetResponse(
        PurchaseRequest $request,
        array $mockedResponse,
        string $controllerClass
    ): TestResponse {
        if (!isset($this->mockedPurchaseService)) {
            throw new \RuntimeException('PurchaseService mock is not initialized.');
        }

        $this->mockedPurchaseService
            ->shouldReceive('processPurchase')
            ->once()
            ->with($request)
            ->andReturn($mockedResponse);

        // Ensure the controller is using the mock
        $controller = new $controllerClass($this->mockedPurchaseService);

        $response = $controller->processPurchase($request);

        return TestResponse::fromBaseResponse($response);
    }
}
