# TechFinancials API client

Using this API client for TechFinancials platform you can open account for your leads, redirect these leads to broker's
website with auto-login and retrieve deposits made by these leads.

## Installation

Install using Composer, doubtless.

```sh
$ composer require resnext/techfinancials-api-client
```

## General API Client usage.

```php
$apiClient = new TechFinancials\ApiClient(<URL>, <USERNAME>, <PASSWORD>, <TRACKING_CODE>);
```