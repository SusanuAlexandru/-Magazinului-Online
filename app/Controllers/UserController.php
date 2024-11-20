<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class UserController
{
    // Obține toți utilizatorii
    public function getAllUsers(Request $request, Response $response): Response
    {
        $users = DB::table('users')->get();
        $response->getBody()->write($users->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Creează un utilizator
    public function createUser(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        DB::table('users')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
        ]);

        $response->getBody()->write('User created successfully.');
        return $response->withStatus(201);
    }

    // Șterge un utilizator
    public function deleteUser(Request $request, Response $response, array $args): Response
    {
        $userId = $args['id'];
        DB::table('users')->where('id', $userId)->delete();

        $response->getBody()->write('User deleted successfully.');
        return $response;
    }
}
