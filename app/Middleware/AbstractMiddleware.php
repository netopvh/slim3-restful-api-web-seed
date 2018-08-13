<?php

namespace App\Middleware;

use App\Interfaces\ContainerAwareInterface;
use App\Interfaces\MiddlewareInterface;
use App\Traits\ContainerAwareTrait;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class AbstractMiddleware.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Middleware
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
abstract class AbstractMiddleware implements ContainerAwareInterface, MiddlewareInterface
{
    use ContainerAwareTrait;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        return $this->handle($request, $response, $next);
    }
}
