<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Year
 */
class Year extends ValueObject implements ValueObjectInterface
{

    /** @var int */
    const MIN_VALUE = 0;

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
        $this->validateIsYear($value);
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
    private function validateIsYear($value)
    {
        $this->throwDomainExceptionUnless($value >= self::MIN_VALUE, 'The supplied value is an unvalid year');
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isLaterThan(Year $year)
    {
        return $this->getValue() > $year->getValue();
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isEqualToOrLaterThan(Year $year)
    {
        return $this->isEqualTo($year) || $this->isLaterThan($year);
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isEqualTo(Year $year)
    {
        return $this->getValue() === $year->getValue();
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isEarlierThan(Year $year)
    {
        return $this->getValue() < $year->getValue();
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isEqualToOrEarlierThan(Year $year)
    {
        return $this->isEqualTo($year) || $this->isEarlierThan($year);
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
        return (string)$this->getValue();
    }
}
