<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use User\Domain\Model\Country;
use User\Event\UserWasRegistered;

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

    private function __construct(Uuid $id, $email, $password, Country $country)
    {
        $this->id = (string) $id;
        $this->setEmail($email);
        $this->setPassword($password);
        $this->country = (string) $country;
    }

    public static function register(Uuid $id, $email, $password, Country $country)
    {
        $user = new self($id, $email, $password, $country);

        $event = new UserWasRegistered((string) $id);
        $user->record($event);

        return $user;
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
        \Assert\that($email)->email();

        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        \Assert\that($password)->string()->minLength(8);

        $this->password = $password;
    }

    public function getCountry()
    {
        return Country::fromCountryCode($this->country);
    }
}
