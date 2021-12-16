<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

class LoginUserAction extends UserAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $user = $this->user->where('name', '=', $data['name'])->get();
        $user_password = ($user[0]->password);
        if (password_verify($data['password'], $user_password)) {
            $key = $_ENV['SECRET_KEY'];
            $payload = array(
                "data" => $user[0]
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            return $this->respondWithData($jwt);
        } else {
            return $this->respondWithData(false);
        }
    }
}