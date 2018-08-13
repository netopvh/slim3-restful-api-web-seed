<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class Controller.
 *
 * @author John Doe <john.doe@example.com>
 *
 * @category Controller
 *
 * @see https://example.com
 */
class Controller extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function indexAction(Request $request, Response $response)
    {
        return $this->renderView($response, 'web/index.html.twig', [
            'controllerName' => 'Controller',
            'controllerLocation' => __DIR__.'/Controller.php',
        ]);
    }
}
