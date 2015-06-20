<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Date
 */
final class Date extends ValueObject implements ValueObjectInterface
{
    /**
     * @var Year
     */
    private $year;

    /**
     * @var Month
     */
    private $month;

    /**
     * @var DayInMonth
     */
    private $dayInMonth;

    /**
     * @param Year $year
     * @param Month $month
     * @param DayInMonth $dayInMonth
     */
    public function __construct(Year $year, Month $month, DayInMonth $dayInMonth)
    {
        $this->validateCominationMakesValidDate($year, $month, $dayInMonth);

        $this->year = $year;
        $this->month = $month;
        $this->dayInMonth = $dayInMonth;
    }

    /**
     * @param Year $year
     * @param Month $month
     * @param DayInMonth $dayInMonth
     *
     * @return \DateTime
     */
    public function validateCominationMakesValidDate(Year $year, Month $month, DayInMonth $dayInMonth)
    {
        $dateString = $year->__toString() . '-' . $month->__toString() . '-' . $dayInMonth->__toString();

        $testFormat = 'Y-n-j'; // year - month - day

        $asDateTime = \DateTime::createFromFormat($testFormat, $dateString);

        $this->throwDomainExceptionIf($asDateTime === false || $asDateTime->format($testFormat) !== $dateString, 'The combination of year, month and day in month is non-existant');
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return Date
     */
    public static function fromDateTime(\DateTime $dateTime)
    {
        return self::fromValues(
            $dateTime->format('Y'),
            $dateTime->format('m'),
            $dateTime->format('d')
        );
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $dayInMonth
     *
     * @return static
     */
    public static function fromValues($year, $month, $dayInMonth)
    {
        return new static(
            new Year($year),
            new Month($month),
            new DayInMonth($dayInMonth)
        );
    }

    /**
     * @return Year
     */
    public function getYear()
    {
        return clone $this->year;
    }

    /**
     * @return Month
     */
    public function getMonth()
    {
        return clone $this->month;
    }

    /**
     * @return DayInMonth
     */
    public function getDayInMonth()
    {
        return clone $this->dayInMonth;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return array(
            $this->getYear()->getValue(),
            $this->getMonth()->getValue(),
            $this->getDayInMonth()->getValue(),
        );
    }
}
