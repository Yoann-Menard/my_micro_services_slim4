<?php

declare(strict_types=1);

namespace App\Application\Actions\Message;

use Psr\Http\Message\ResponseInterface as Response;

class ListMessagesAction extends MessageAction
{
    protected function action(): Response
    {
        $allMessages = $this->message->all();
        return $this->respondWithData($allMessages);
    }
}