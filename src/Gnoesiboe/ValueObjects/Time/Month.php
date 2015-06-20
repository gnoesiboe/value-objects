<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Month
 */
class Month extends ValueObject implements ValueObjectInterface
{

    /** @var int */
    const MIN_VALUE = 1;

    /** @var int */
    const MAX_VALUE = 12;


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
        $this->validateIsMonth($value);
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
    private function validateIsMonth($value)
    {
        $this->throwDomainExceptionUnless($value < self::MIN_VALUE || $value > self::MAX_VALUE, 'The supplied value is an unvalid month');
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isLaterThan(Month $month)
    {
        return $this->getValue() > $month->getValue();
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isEqualToOrLaterThan(Month $month)
    {
        return $this->isEqualTo($month) || $this->isLaterThan($month);
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isEqualTo(Month $month)
    {
        return $this->getValue() === $month->getValue();
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isEarlierThan(Month $month)
    {
        return $this->getValue() < $month->getValue();
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isEqualToOrEarlierThan(Month $month)
    {
        return $this->isEqualTo($month) || $this->isEarlierThan($month);
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
