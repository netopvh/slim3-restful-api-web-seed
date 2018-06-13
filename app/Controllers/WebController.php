<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class WebController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class WebController extends AbstractController
{

    /**
     * 
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function indexAction(Request $request, Response $response)
    {
        return $this->renderView($response, "web/index.html.twig", [
            "controllerName" => "WebController",
            "controllerLocation" => __DIR__ . "/WebController.php"
        ]);
    }

}
