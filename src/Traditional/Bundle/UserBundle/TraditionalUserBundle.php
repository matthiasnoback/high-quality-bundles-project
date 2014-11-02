<?php

namespace Traditional\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Traditional\Bundle\UserBundle\DependencyInjection\UserExtension;

class TraditionalUserBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserExtension();
    }
}
