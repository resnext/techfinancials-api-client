<?php

namespace TechFinancials\Tests;

use GuzzleHttp\Psr7\Response;
use TechFinancials\Requests\RegisterTraderRequest;
use TechFinancials\Responses\RegisterTraderResponse;

class RegisterTraderTest extends TestCase
{
    public function testSuccessfulResponse()
    {
        $apiResponse = new Response(200, [], $this->getStub('successfulRegisterTrader.json'));

        $this->mockResponse($apiResponse);

        $request = new RegisterTraderRequest();

        $response = $this->apiClient->registerTrader($request);

        $this->assertTrue($response instanceof RegisterTraderResponse);

        $this->assertEquals(831176, $response->getId(), 'Registered trader ID should be equals 831176 for used stub.');

        $this->assertNotEmpty($response->getDepositPageUrl());
    }

    public function testRegistrationWithExistedEmail()
    {
        $apiResponse = new Response(200, [], $this->getStub('successfulRegisterTrader.json'));

        $this->mockResponse($apiResponse);

        $request = new RegisterTraderRequest();

        $response = $this->apiClient->registerTrader($request);
    }
}
