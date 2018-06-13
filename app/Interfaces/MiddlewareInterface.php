<?php

namespace App\Interfaces;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Interface MiddlewareInterface
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Interface
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
interface MiddlewareInterface
{

    /**
     * 
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, Response $response, callable $next): Response;
}
