<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class Middleware.
 */
class Middleware extends AbstractMiddleware
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function handle(Request $request, Response $response, callable $next): Response
    {
        $response = $next($request, $response);

        // ...

        return $response;
    }
}
