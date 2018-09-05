<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class AuthMiddleware.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Middleware
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class AuthMiddleware extends AbstractMiddleware
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
        if (!$header = $this->getAuthorizationHeader($request)) {
            return $response->withStatus(401);
        }
        try {
            $this->getContainer()->get('auth')->authenticate($header);
        } catch (Exception $e) {
            return $response->withJson(['message' => $e->getMessage()], 401);
        }

        return $next($request, $response);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function getAuthorizationHeader(Request $request)
    {
        if (!list($header) = $request->getHeader('Authorization', false)) {
            return false;
        }

        return $header;
    }
}
