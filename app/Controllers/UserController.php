<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

class UserController
{
    // Înregistrare utilizator
    public function registerUser(Request $request, Response $response)
    {
        ob_start();
        require '../views/register.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Autentificare utilizator
    public function loginUser(Request $request, Response $response)
    {
        ob_start();
        require '../views/login.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Deconectare utilizator
    public function logoutUser(Request $request, Response $response)
    {
        // Logica de deconectare
        return $response->withHeader('Location', '/login')->withStatus(302);
    }

    // Vizualizare profil utilizator
    public function getUserProfile(Request $request, Response $response)
    {
        $user = User::find($request->getAttribute('user_id'));
        ob_start();
        require '../views/profile.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Actualizare profil utilizator
    public function updateUserProfile(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $user = User::find($request->getAttribute('user_id'));
        $user->update($data);

        return $response
            ->withHeader('Location', '/profile')
            ->withStatus(302);
    }
}
