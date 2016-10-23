<?php

namespace TechFinancials;

use GuzzleHttp;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use TechFinancials\Requests\RegisterTraderRequest;
use TechFinancials\Responses\FindAccountsResponse;
use TechFinancials\Responses\RegisterTraderResponse;

class ApiClient implements LoggerAwareInterface
{

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;


    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __construct($url, $username, $password, $options = [])
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;

        if (isset($options['httpClient']) && $options['httpClient'] instanceof GuzzleHttp\ClientInterface) {
            $this->httpClient = $options['httpClient'];
        }
    }

    public function registerTrader(RegisterTraderRequest $request)
    {
        $data = [
            'userName' => $request->getUsername(),
            'password' => $request->getPassword(),
            'firstName' => $request->getFirstName(),
            'lastName' => $request->getLastName(),
            'phoneNumber' => $request->getPhone(),
            'countryId' => $request->getCountryCode(),
            'currencyId' => $request->getCurrencyCode(),
            'email' => $request->getEmail(),
            'siteLanguage' => $request->getLanguage(),
            'trackingCode' => $request->getTrackingCode(),
        ];

        $payload = new Payload($this->request('/marketeer/customer/registerTrader', $data));

        return new RegisterTraderResponse($payload);
    }

    /**
     * @param string $accountId
     *
     * @return \TechFinancials\Responses\FindAccountsResponse
     */
    public function findAccounts($accountId = null)
    {
        $data = [];

        if (!is_null($accountId)) {
            $data['accountID'] = $accountId;
        }

        $payload = new Payload($this->request('/marketeer/customer/findAccounts', $data));

        return new FindAccountsResponse($payload);
    }

    /**
     * Adds API credentials to request data
     *
     * @param $data
     */
    protected function sign(&$data)
    {
        $data['affiliateUserName'] = $this->username;
        $data['affiliatePassword'] = $this->password;
    }

    /**
     * Sends request to Solaris API endpoint.
     *
     * @param string $uri
     * @param array  $data
     *
     * @return string
     */
    protected function request($uri, $data = [])
    {
        $this->sign($data);

        $url = $this->url . $uri;
        $url .= '?' . http_build_query($data);
        try {

            return (string) $this->getHttpClient()->post($url, [
                GuzzleHttp\RequestOptions::HEADERS => [
                    'User-Agent' => 'ResNext / TechFinancials API Client',
                ]
            ])->getBody();
        } catch (GuzzleHttp\Exception\ConnectException $e) {

            return new ClientException($e->getMessage());
        } catch (GuzzleHttp\Exception\ClientException $e) {

            return (string) $e->getResponse()->getBody();
        } catch (GuzzleHttp\Exception\ServerException $e) {

            return (string) $e->getResponse()->getBody();
        }
    }

    /**
     * This method should be used instead direct access to property $httpClient
     *
     * @return \GuzzleHttp\ClientInterface|GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if (!is_null($this->httpClient)) {

            return $this->httpClient;
        }
        $stack = GuzzleHttp\HandlerStack::create();
        if ($this->logger instanceof LoggerInterface) {
            $stack->push(GuzzleHttp\Middleware::log(
                $this->logger,
                new GuzzleHttp\MessageFormatter(GuzzleHttp\MessageFormatter::DEBUG)
            ));
        }
        $this->httpClient = new GuzzleHttp\Client([
            'handler' => $stack,
        ]);

        return $this->httpClient;
    }
}
