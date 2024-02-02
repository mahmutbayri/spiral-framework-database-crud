<?php

namespace App\Endpoint\Web\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function in_array;

/**
 * https://github.com/symfony/http-foundation/blob/6.1/Request.php#L1200
 */
class HttpMethodOverride implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $method = $request->getMethod();

        if ($method !== 'POST') {
            return $handler->handle($request);
        }

        $body = $request->getParsedBody();

        if (is_array($body) && isset($body['_method'])) {
            $method = $body['_method'];
        }

        $availableMethods = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'PATCH', 'PURGE', 'TRACE'];

        if (in_array($method, $availableMethods, true)) {
            return $handler->handle($request->withMethod($method));
        }

        return $handler->handle($request);
    }
}
