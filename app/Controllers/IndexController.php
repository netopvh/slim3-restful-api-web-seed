<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class IndexController.
 */
class IndexController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function indexView(Request $request, Response $response): Response
    {
        return $this->renderView($response, 'index/index.html.twig', [
            'controllerName' => 'IndexController',
            'controllerLocation' => __DIR__.'/IndexController.php',
        ]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function getAction(Request $request, Response $response): Response
    {
        return $response->withJson([
            'controllerName' => 'IndexController',
            'controllerLocation' => __DIR__.'/IndexController.php',
        ]);
    }
}
