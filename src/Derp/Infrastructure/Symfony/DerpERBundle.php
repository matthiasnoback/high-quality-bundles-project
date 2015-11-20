<?php

namespace Derp\Infrastructure\Symfony;

use Derp\Infrastructure\Symfony\DerpERExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DerpERBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new DerpERExtension();
    }
}
