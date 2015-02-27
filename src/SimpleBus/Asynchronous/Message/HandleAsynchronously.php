<?php

namespace SimpleBus\Asynchronous\Message;

use SimpleBus\Message\Message;

/**
 * Marker interface for Messages that should be handled asynchronously
 */
interface HandleAsynchronously extends Message
{
}
