# saxulum-http-client-adapter-joomla

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-http-client-adapter-joomla.png?branch=master)](https://travis-ci.org/saxulum/saxulum-http-client-adapter-joomla)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-http-client-adapter-joomla/downloads.png)](https://packagist.org/packages/saxulum/saxulum-http-client-adapter-joomla)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-http-client-adapter-joomla/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-http-client-adapter-joomla)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-http-client-adapter-joomla/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/saxulum/saxulum-http-client-adapter-joomla/?branch=master)

## Features

 * Provides a http client interface adapter for [joomla][1]

## Requirements

 * PHP 5.3+
 * Joomla Http ~1.1

## Installation

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-http-client-adapter-joomla][2].

## Usage

``` {.php}
use Saxulum\HttpClient\Joomla\HttpClient;
use Saxulum\HttpClient\Request;

$httpClient = new HttpClient();
$response = $httpClient->request(new Request(
    '1.1',
    Request::METHOD_GET,
    'http://en.wikipedia.org',
    array(
        'Connection' => 'close',
    )
));
```

You can inject your own joomla browser instance while creating the http client instance.

``` {.php}
use Joomla\Http\Http;
use Joomla\Http\Transport\Stream as StreamTransport;
use Saxulum\HttpClient\Joomla\HttpClient;

$options = array();
$transport = new StreamTransport($options);
$http = new Http($options, $transport);

$httpClient = new HttpClient($http);
```

[1]: https://packagist.org/packages/joomla/http
[2]: https://packagist.org/packages/saxulum/saxulum-http-client-adapter-joomla