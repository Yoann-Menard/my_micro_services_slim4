<?php

declare(strict_types=1);

namespace App\Application\Actions\Message;

use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\Message\Message;

class UpdateMessageAction extends MessageAction
{
    protected function action(): Response
    {
        $data = $this->parseBody();
        $messageId = (int) $this->resolveArg('id');
        $message = $this->message->find($messageId);
        foreach($data as $key => $value) {
            if (isset($message->$key))
            $message->$key = $value;
        }
        $message->save();
        return $this->respondWithData($message);
    }
}