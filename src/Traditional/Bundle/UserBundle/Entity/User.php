<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use Traditional\Domain\Model\Country;
use Traditional\Event\UserRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="traditional_user")
 */
class User implements ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    public function __construct(Uuid $id, $email, $password, Country $country)
    {
        $this->id = $id;
        $this->setEmail($email);
        $this->setPassword($password);
        $this->country = (string) $country;

        $this->record(new UserRegistered((string) $id));
    }

    public function getId()
    {
        return Uuid::fromString($this->id);
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function setEmail($email)
    {
        Assertion::email($email);

        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        Assertion::string($password);
        Assertion::minLength($password, 1);

        $this->password = $password;
    }

    public function getCountry()
    {
        return Country::fromCountryCode($this->country);
    }
}
