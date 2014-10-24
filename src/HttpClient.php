<?php

namespace Saxulum\HttpClient\Joomla;

use Joomla\Http\HttpFactory;
use Joomla\Http\Http;
use Joomla\Http\Response as JoomlaResponse;
use Saxulum\HttpClient\HttpClientInterface;
use Saxulum\HttpClient\Request;
use Saxulum\HttpClient\Response;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Http
     */
    protected $http;

    /**
     * @param Http $http
     */
    public function __construct(Http $http = null)
    {
        $this->http = null !== $http ? $http : HttpFactory::getHttp();
    }

    /**
     * @param  Request    $request
     * @return Response
     * @throws \Exception
     */
    public function request(Request $request)
    {
        $methodName = strtolower($request->getMethod());

        if (!is_callable(array($this, $methodName))) {
            throw new \Exception("Unsupported method '{$request->getMethod()}'!");
        }

        /** @var JoomlaResponse $joomlaResponse */
        $joomlaResponse = $this->$methodName($request);

        return new Response(
            (string) $request->getProtocolVersion(),
            $joomlaResponse->code,
            self::getStatusMessage($joomlaResponse->code),
            $joomlaResponse->headers,
            $joomlaResponse->body
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function options(Request $request)
    {
        return $this->http->options(
            (string) $request->getUrl(),
            $request->getHeaders()
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function get(Request $request)
    {
        return $this->http->get(
            (string) $request->getUrl(),
            $request->getHeaders()
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function head(Request $request)
    {
        return $this->http->head(
            (string) $request->getUrl(),
            $request->getHeaders()
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function post(Request $request)
    {
        return $this->http->post(
            (string) $request->getUrl(),
            $request->getContent(),
            $request->getHeaders()
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function put(Request $request)
    {
        return $this->http->put(
            (string) $request->getUrl(),
            $request->getContent(),
            $request->getHeaders()
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function delete(Request $request)
    {
        return $this->http->delete(
            (string) $request->getUrl(),
            $request->getHeaders()
        );
    }

    /**
     * @param  Request        $request
     * @return JoomlaResponse
     */
    protected function patch(Request $request)
    {
        return $this->http->patch(
            (string) $request->getUrl(),
            $request->getContent(),
            $request->getHeaders()
        );
    }

    /**
     * @param  int        $statusCode
     * @return string
     * @throws \Exception
     */
    protected static function getStatusMessage($statusCode)
    {
        static $reflectionHttpClientInterface;

        if (null === $reflectionHttpClientInterface) {
            $httpClientInterface = 'Saxulum\HttpClient\HttpClientInterface';
            $reflectionHttpClientInterface = new \ReflectionClass($httpClientInterface);
        }

        $constantName = self::getCodeConstantName($statusCode);

        if (!$reflectionHttpClientInterface->hasConstant($constantName)) {
            throw new \Exception("Unknown status code {$statusCode}!");
        }

        return $reflectionHttpClientInterface->getConstant($constantName);
    }

    /**
     * @param  int    $statusCode
     * @return string
     */
    protected static function getCodeConstantName($statusCode)
    {
        return 'CODE_' . $statusCode;
    }
}
