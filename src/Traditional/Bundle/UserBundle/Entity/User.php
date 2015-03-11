<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use Symfony\Component\Intl\Intl;
use Traditional\Bundle\UserBundle\Event\UserWasRegistered;

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

    public function __construct($id, EmailAddress $email, $password, $country)
    {
        $this->id = $id;
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setCountry($country);
    }

    public static function register($id, EmailAddress $email, $password, $country)
    {
        $user = new self($id, $email, $password, $country);

        $user->record(new UserWasRegistered($id));

        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return EmailAddress::fromString($this->email);
    }

    private function setEmail(EmailAddress $email)
    {
        $this->email = (string) $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        Assertion::string($password);
        Assertion::notEmpty($password);

        $this->password = $password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    private function setCountry($country)
    {
        Assertion::string($country);
        Assertion::notNull(Intl::getRegionBundle()->getCountryName($country), 'Not a country');

        $this->country = $country;
    }
}
