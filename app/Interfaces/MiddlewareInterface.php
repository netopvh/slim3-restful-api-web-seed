<?php

namespace App\Interfaces;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Interface MiddlewareInterface.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Interface
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
interface MiddlewareInterface
{
    /**
     * Manipulates the Request and Response objects. You MUST return an instance of
     * \Psr\Http\Message\ResponseInterface and should invoke the next middleware,
     * passing it Request and Response objects as arguments.
     *
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function handle(Request $request, Response $response, callable $next): Response;
}
