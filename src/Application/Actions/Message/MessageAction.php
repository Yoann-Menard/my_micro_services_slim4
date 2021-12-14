<?php

declare(strict_types=1);

namespace App\Application\Actions\Message;

use App\Application\Actions\Action;
use App\Domain\Message\Message;
use Psr\Log\LoggerInterface;

abstract class MessageAction extends Action
{
    /**
    * @var Message
    */
    protected $message;
    
    /**
    * @param LoggerInterface $logger
    * @param Message  $message
    */
    public function __construct(LoggerInterface $logger, Message $message)
    {
        parent::__construct($logger);
        $this->message = $message;
    }
    
    protected function parseBody() {
        // parsing from key=value&key2=value2 to [key => value, key2 => value2]
        $data;
        $raw = $this->request->getBody()->getContents();
        if (empty($raw))
            return $this->request->getParsedBody();
        $cutted = explode("&", $raw);
        foreach ($cutted as $param) {
            list($key, $value) = explode("=", $param);
            $data[$key] = $value;
        }
        return $data;
    }
}