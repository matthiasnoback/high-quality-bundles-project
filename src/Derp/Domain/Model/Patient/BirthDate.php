<?php

namespace Derp\Domain\Model\Patient;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use DateInterval;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;

/**
 * @ORM\Embeddable()
 */
class BirthDate
{
    /**
     * @ORM\Column(type="datetime", name="birthDate")
     * @Serialize\Type("DateTime")
     * @var DateTime
     */
    private $date;

    private function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    public static function fromYearMonthDayFormat($yearMonthDay)
    {
        return new BirthDate(
            DateTime::createFromFormat('Y-m-d H:i:s', $yearMonthDay .' 00:00:00')
        );
    }

    /**
     * @param integer $age
     * @return BirthDate
     */
    public static function fromEstimatedAge($age)
    {
        return new static(
            (new DateTime('now'))->sub(new \DateInterval("P{$age}Y"))
        );
    }

    public function getCurrentAge()
    {
        $diff = $this->date->diff(new DateTime('now'));
        return $diff->format('Y');
    }

    public function toDateTime()
    {
        return $this->date;
    }
}
