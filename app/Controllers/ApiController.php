<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class DefaultController.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Controller
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class ApiController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function getAction(Request $request, Response $response)
    {
        return $response->withJson([
            'controllerName' => 'ApiController',
            'controllerLocation' => __DIR__.'/ApiController.php',
        ]);
    }
}
