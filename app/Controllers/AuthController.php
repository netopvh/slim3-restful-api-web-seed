<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class AuthController.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Controller
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class AuthController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function postAction(Request $request, Response $response): Response
    {
        $username = $request->getParam('username', '');
        $password = $request->getParam('password', '');

        if (!$token = $this->getAuth()->attempt($username, $password)) {
            return $response->withStatus(401);
        }

        return $response->withJson([
            'token' => $token,
        ]);
    }
}
