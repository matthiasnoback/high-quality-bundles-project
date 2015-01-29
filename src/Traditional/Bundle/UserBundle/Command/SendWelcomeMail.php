<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Message\Type\Command;
use Traditional\Bundle\UserBundle\Entity\User;

class SendWelcomeMail implements Command, NamedMessage
{
    /**
     * @var User
     */
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }

    public static function messageName()
    {
        return 'send_welcome_mail';
    }
}
