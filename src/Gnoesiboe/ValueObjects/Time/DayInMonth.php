<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class DayInMonth
 */
final class DayInMonth extends SingleValueObject implements ValueObjectInterface
{

    /** @var int */
    const MIN_VALUE = 0;

    /** @var int */
    const MAX_VALUE = 31;

    /**
     * @var \Gnoesiboe\ValueObjects\Numerical\Integer
     */
    private $value;

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     */
    public function __construct(Integer $value)
    {
        $this->setValue($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     */
    private function setValue(Integer $value)
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     */
    private function validateValue(Integer $value)
    {
        $this->validateIsDayInMonth($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     */
    private function validateIsDayInMonth(Integer $value)
    {
        $this->throwDomainExceptionUnless(
            $value->isLessThan(new Integer(self::MIN_VALUE)) || $value->isBiggerThan(new Integer(self::MAX_VALUE)),
            'The supplied value is an unvalid day'
        );
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isLaterThan(DayInMonth $dayInMonth)
    {
        return $this->getValue()->isBiggerThan($dayInMonth->getValue());
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isEqualToOrLaterThan(DayInMonth $dayInMonth)
    {
        return $this->isEqualTo($dayInMonth) || $this->isLaterThan($dayInMonth);
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isEqualTo(DayInMonth $dayInMonth)
    {
        return $this->getValue()->isEqualTo($dayInMonth->getValue());
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isEarlierThan(DayInMonth $dayInMonth)
    {
        return $this->getValue()->isLessThan($dayInMonth->getValue());
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isEqualToOrEarlierThan(DayInMonth $dayInMonth)
    {
        return $this->isEqualTo($dayInMonth) || $this->isEarlierThan($dayInMonth);
    }

    /**
     * @return \Gnoesiboe\ValueObjects\Numerical\Integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }
}
