<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class MessageGenerator
{
    private LoggerInterface $logger;
    public string $str;

    public function __construct(LoggerInterface $logger, string $str)
    {
        $this->logger = $logger;
        $this->str = $str;
    }

    public function getHappyMessage(): string
    {
        $this->logger->info('About to find a happy message!');
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}