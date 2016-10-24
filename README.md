# TechFinancials API client

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/resnext/techfinancials-api-client.svg?style=flat-square&branch=master)](https://travis-ci.org/resnext/techfinancials-api-client)
[![codecov](https://codecov.io/gh/resnext/techfinancials-api-client/branch/master/graph/badge.svg)](https://codecov.io/gh/resnext/techfinancials-api-client)
[![codecov](https://img.shields.io/codecov/c/gh/resnext/techfinancials-api-client.svg)](https://codecov.io/gh/resnext/techfinancials-api-client)

Using this API client for TechFinancials platform you can open account for your leads, redirect these leads to broker's
website with auto-login and retrieve deposits made by these leads.

## Installation

Install using Composer, doubtless.

```sh
$ composer require resnext/techfinancials-api-client
```

## General API Client usage.

```php
$apiClient = new TechFinancials\ApiClient(<URL>, <USERNAME>, <PASSWORD>);
```

### Trader registration

```php
$request = new \TechFinancials\Requests\RegisterTraderRequest([
    'username' => 'email@domain.com',
    'firstName' => 'John',
    'lastName' => 'Smith',
    'email' => 'email@domain.com',
    'phone' => '12345678909',
    'countryCode' => 'DE',
    'currencyCode' => 'EUR',
    'password' => 'password',
    'trackingCode' => 'Your tracking code'
]);
/** @var \TechFinancials\Responses\RegisterTraderResponse $response */    
$response = $apiClient->registerTrader($request);
```

### Find registered traders

```php
/** @var \TechFinancials\Responses\FindAccountsResponse $response */
$response = $apiClient->findAccounts();
/** @var \TechFinancials\Entities\Account[] $accounts */
$accounts = $response->getAccounts();
```