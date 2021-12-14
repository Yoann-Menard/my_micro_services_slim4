<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\User\User;

class AddUserAction extends UserAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $user = new User;
        // $user->name = $data['name'];
        // $user->email = $data['email'];
        // $user->password = $data['password'];
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        var_dump($user);
        $user->save();
        return $this->respondWithData($user);
    }
}