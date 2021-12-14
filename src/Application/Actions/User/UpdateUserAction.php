<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\User\User;

class UpdateUserAction extends UserAction
{
    protected function action(): Response
    {
        $data = $this->parseBody();
        $userId = (int) $this->resolveArg('id');
        $user = $this->user->find($userId);
        foreach($data as $key => $value) {
            if (isset($user->$key))
            $user->$key = $value;
        }
        $user->save();
        return $this->respondWithData($user);
    }
}