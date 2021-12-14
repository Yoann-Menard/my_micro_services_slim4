<?php

declare(strict_types=1);

namespace App\Application\Actions\Message;

use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\Message\Message;

class AddMessageAction extends MessageAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $message = new Message;
        $message->name = $data["name"];
        $message->save();
        return $this->respondWithData($message);
    }
}