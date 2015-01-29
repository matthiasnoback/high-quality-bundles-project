<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use Symfony\Component\Intl\Intl;
use Traditional\Bundle\UserBundle\Event\UserRegistered;

/**
 * @ORM\Entity(repositoryClass="Traditional\Bundle\UserBundle\Entity\DoctrineUserRepository")
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
     * @ORM\Column(type="email_address")
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

    /**
     * @ORM\OneToMany(targetEntity="Traditional\Bundle\UserBundle\Entity\PhoneNumber", orphanRemoval=true, cascade={"persist", "remove"}, mappedBy="user")
     */
    private $phoneNumbers;

    private function __construct($id, EmailAddress $email, $password, $country)
    {
        $this->id = $id;
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setCountry($country);

        $this->phoneNumbers = new ArrayCollection();
    }

    public static function register($id, EmailAddress $email, $password, $country)
    {
        $user = new self($id, $email, $password, $country);

        $event = new UserRegistered($user);
        $user->record($event);

        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return EmailAddress
     */
    public function getEmail()
    {
        return $this->email;
    }

    private function setEmail(EmailAddress $email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        Assertion::notNull($password);
        Assertion::string($password);

        $this->password = $password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    private function setCountry($country)
    {
        Assertion::notNull(
            Intl::getRegionBundle()->getCountryName($country),
            'Invalid country'
        );

        $this->country = $country;
    }

    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    public function addPhoneNumber(PhoneNumber $phoneNumber)
    {
        $phoneNumber->setUser($this);
        $this->phoneNumbers->add($phoneNumber);
    }
}
