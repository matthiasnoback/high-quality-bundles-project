<?php

namespace Derp\Command;

use SimpleBus\Message\Message;

class RegisterWalkIn implements Message
{
    public $id;
    public $firstName;
    public $lastName;
    public $sex;
    public $dateOfBirth;
    public $indication;
}
