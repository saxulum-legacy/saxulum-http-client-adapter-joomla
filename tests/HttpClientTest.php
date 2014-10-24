<?php

namespace Saxulum\Tests\HttpClient\Joomla;

use Saxulum\HttpClient\Joomla\HttpClient;
use Saxulum\HttpClient\Request;

class HttpClientTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $httpClient = new HttpClient();

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_GET,
            'http://httpbin.org/get?key=value',
            array(
                'Connection' => 'close',
            )
        ));

        $content = json_decode($response->getContent(), true);

        $this->assertEquals('1.1', $response->getProtocolVersion());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
        $this->assertEquals(array('key' => 'value'), $content['args']);
    }

    public function testPost()
    {
        $httpClient = new HttpClient();

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_POST,
            'http://httpbin.org/post',
            array(
                'Connection' => 'close',
            ),
            'key=value'
        ));

        $content = json_decode($response->getContent(), true);

        $this->assertEquals('1.1', $response->getProtocolVersion());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
        $this->assertEquals(array('key' => 'value'), $content['form']);
    }

    public function testPut()
    {
        $httpClient = new HttpClient();

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_PUT,
            'http://httpbin.org/put',
            array(
                'Connection' => 'close',
            ),
            'key=value'
        ));

        $content = json_decode($response->getContent(), true);
        $this->assertEquals('1.1', $response->getProtocolVersion());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
        $this->assertEquals(array('key' => 'value'), $content['form']);
    }

    public function testDelete()
    {
        $httpClient = new HttpClient();

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_DELETE,
            'http://httpbin.org/delete?key=value',
            array(
                'Connection' => 'close',
            )
        ));

        $content = json_decode($response->getContent(), true);

        $this->assertEquals('1.1', $response->getProtocolVersion());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
        $this->assertEquals(array('key' => 'value'), $content['args']);
    }

    public function testPatch()
    {
        $httpClient = new HttpClient();

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_PATCH,
            'http://httpbin.org/patch',
            array(
                'Connection' => 'close',
            ),
            'key=value'
        ));

        $content = json_decode($response->getContent(), true);
        $this->assertEquals('1.1', $response->getProtocolVersion());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
        $this->assertEquals(array('key' => 'value'), $content['form']);
    }
}
