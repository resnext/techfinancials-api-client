# TechFinancials API client

[![License](https://img.shields.io/packagist/l/resnext/techfinancials-api-client.svg?style=flat-square)](https://packagist.org/packages/resnext/techfinancials-api-client)
[![Build Status](https://img.shields.io/travis/resnext/techfinancials-api-client.svg?style=flat-square&branch=master)](https://travis-ci.org/resnext/techfinancials-api-client)

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