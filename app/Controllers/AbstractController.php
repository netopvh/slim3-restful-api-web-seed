<?php

namespace App\Controllers;

use App\Interfaces\ContainerAwareInterface;
use App\Traits\ContainerAwareTrait;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

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
     * AbstractController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * Build the path for a named route including the base path.
     *
     *
     * @param string $name        Route name
     * @param array  $data        Optional named argument replacement data
     * @param array  $queryParams Optional query string parameters
     *
     * @return string
     */
    public function getPathFor(string $name, array $data = [], array $queryParams = []): string
    {
        return $this->getContainer()->get('router')->pathFor($name, $data, $queryParams);
    }

    /**
     * Output rendered template.
     *
     * @param ResponseInterface $response
     * @param string            $template Template pathname relative to templates directory
     * @param array             $data     Optional associative array of template variables
     *
     * @return ResponseInterface
     */
    public function renderView(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        return $this->getContainer()->get('view')->render($response, $template, $data);
    }
}
