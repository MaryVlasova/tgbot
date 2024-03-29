<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;
use Telegram;

/**
 * Class HelpCommand.
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Help command, Get a list of all commands';

    /**
     * @return mixed
     */
    public function handle()
    
    {
        $response = $this->getUpdate();
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $text = 'Hey stranger, thanks for visiting me.'.chr(10).chr(10);
        $text .= 'I am a bot and working for'.chr(10);
        $text .= env('APP_URL').chr(10).chr(10);
        $text .= 'Please come and visit me there.'.chr(10);
        
        return $this->replyWithMessage(compact('text'));

    }
}