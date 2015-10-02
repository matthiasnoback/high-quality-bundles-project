<?php

namespace Derp\Bundle\ERBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable()
 */
class Sex
{
    const MALE = 'male';

    const FEMALE = 'female';

    const INTERSEX = 'intersex';

    /**
     * @ORM\Column(name="sex", type="string", length=10)
     * @Assert\Choice(choices={"male", "female", "intersex"})
     */
    private $value;

//    public function __construct($sex)
//    {
//        $this->setSex($sex);
//    }

    /**
     * compromise
     */
    public function setSex($sex)
    {
        if ($sex !== static::MALE && $sex !== static::FEMALE && $sex !== static::INTERSEX) {
            throw new \InvalidArgumentException('Invalid sex provided');
        }

        $this->value = $sex;
    }

    public function getSex()
    {
        return $this->value;
    }

    public function isFemale()
    {
        return $this->value === self::FEMALE;
    }
}
