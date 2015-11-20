<?php

namespace Derp\Domain\Model\Patient;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;

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
     * @Serialize\Type("string")
     */
    private $value;

    public function __construct($sex)
    {
        $this->setSex($sex);
    }

    private function setSex($sex)
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
