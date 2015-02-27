<?php

namespace SimpleBus\Asynchronous\Message\Envelope;

use Assert\Assertion;

class DefaultMessageEnvelope implements MessageEnvelope
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $serializedMessage;

    public function __construct($type, $serializedMessage)
    {
        $this->setType($type);
        $this->setSerializedMessage($type, $serializedMessage);
    }

    public function type()
    {
        return $this->type;
    }

    public function serializedMessage()
    {
        return $this->serializedMessage;
    }

    private function setType($type)
    {
        Assertion::string($type);
        Assertion::true(class_exists($type));

        $this->type = $type;
    }

    private function setSerializedMessage($type, $serializedMessage)
    {
        Assertion::string($type);
        $this->serializedMessage = $serializedMessage;
    }
}
