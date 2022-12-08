<?php

namespace App\Message;

use App\Command\QueueCommand;

class QueueCommandMessage
{
    protected string $commandName = '';

    public function __construct()
    {
        $this->commandName = QueueCommand::getDefaultName();
    }

    public function getCommandName(): ?string
    {
        return $this->commandName;
    }
}