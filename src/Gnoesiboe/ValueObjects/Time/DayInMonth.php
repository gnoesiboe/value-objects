<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class DayInMonth
 */
final class DayInMonth extends ValueObject implements ValueObjectInterface
{

    /** @var int */
    const MIN_VALUE = 0;

    /** @var int */
    const MAX_VALUE = 31;

    /**
     * @varint
     */
    private $value;

    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param int $value
     */
    private function setValue($value)
    {
        $this->validateValue($value);

        $this->value = (int)$value;
    }

    /**
     * @param int $value
     */
    protected function validateValue($value)
    {
        $this->validateIsInteger($value);
        $this->validateIsDayInMonth($value);
    }

    /**
     * @param int $value
     */
    private function validateIsInteger($value)
    {
        $this->throwDomainExceptionIf(filter_var($value, FILTER_VALIDATE_INT) === false, 'Value should be of type int');
    }

    /**
     * @param int $value
     */
    private function validateIsDayInMonth($value)
    {
        $this->throwDomainExceptionUnless($value < self::MIN_VALUE || $value > self::MAX_VALUE, 'The supplied value is an unvalid day');
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isLaterThan(DayInMonth $dayInMonth)
    {
        return $this->getValue() > $dayInMonth->getValue();
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
        return $this->getValue() === $dayInMonth->getValue();
    }

    /**
     * @param DayInMonth $dayInMonth
     *
     * @return bool
     */
    public function isEarlierThan(DayInMonth $dayInMonth)
    {
        return $this->getValue() < $dayInMonth->getValue();
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
     * @return int
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
