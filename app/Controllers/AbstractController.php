<?php

namespace App\Controllers;

use App\Interfaces\ContainerAwareInterface;
use App\Traits\ContainerAwareTrait;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class AbstractController.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Controller
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
abstract class AbstractController implements ContainerAwareInterface
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
     * @param string $path
     * @param array  $data   optional
     * @param array  $params optional
     *
     * @return string
     */
    public function getPathFor(string $path, array $data = [], array $params = [])
    {
        return $this->getContainer()->get('router')->pathFor($path, $data, $params);
    }

    /**
     * @param Response $response
     * @param string   $template
     * @param array    $data     optional
     *
     * @return Response
     */
    public function renderView(Response $response, string $template, array $data = [])
    {
        return $this->getContainer()->get('view')->render($response, $template, $data);
    }
}
