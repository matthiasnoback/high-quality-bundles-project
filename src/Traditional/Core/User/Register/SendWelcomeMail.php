<?php

namespace Traditional\Core\User\Register;

use SimpleBus\Command\Command;

class SendWelcomeMail implements Command
{
    /**
     * @var
     */
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'send_welcome_mail';
    }
}
