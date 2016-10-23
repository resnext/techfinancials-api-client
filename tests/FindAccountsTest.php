<?php

namespace TechFinancials\Tests;

use GuzzleHttp\Psr7\Response;
use TechFinancials\Responses\FindAccountsResponse;

class FindAccountsTest extends TestCase
{
    public function testSuccessfulResponse()
    {
        $apiResponse = new Response(200, [], $this->getStub('successfulFindAccounts.json'));

        $this->mockResponse($apiResponse);

        $response = $this->apiClient->findAccounts();

        $this->assertTrue($response instanceof FindAccountsResponse);

        $accounts = $response->getAccounts();

        $this->assertTrue(is_array($accounts));

        $account = $accounts[0];

        $this->assertEquals($account->getId(), 764210);
        $this->assertEquals($account->getEmail(), 'email@domain.com');
    }
}
