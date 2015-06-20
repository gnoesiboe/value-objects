<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Hour
 */
class Hours extends ValueObject implements ValueObjectInterface
{

    /** @var int */
    const MAX_VALUE = 23;

    /** @var int */
    const MIN_VALUE = 0;


    /**
     * @var int
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
     *
     * @throws DomainException
     */
    private function validateValue($value)
    {
        $this->validateIsInteger($value);
        $this->validateIsHours($value);
    }

    /**
     * @param int $value
     *
     * @throws DomainException
     */
    private function validateIsHours($value)
    {
        $value = (int)$value;

        $this->throwDomainExceptionIf($value < self::MIN_VALUE || $value > self::MAX_VALUE, 'Value should be between ' . self::MIN_VALUE . ' and ' . self::MAX_VALUE);
    }

    /**
     * @param int $value
     *
     * @throws DomainException
     */
    private function validateIsInteger($value)
    {
        $this->throwDomainExceptionIf(filter_var($value, FILTER_VALIDATE_INT) === false, 'Value should be of type int');
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Hours $hours
     *
     * @return bool
     */
    public function isEqualTo(Hours $hours)
    {
        return $hours->getValue() === $this->getValue();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @param Hours $start
     * @param Hours $end
     *
     * @return bool
     */
    public function isBetween(Hours $start, Hours $end)
    {
        if ($this->isEqualTo($start) === true || $this->isEqualTo($end) === true) {
            return true;
        }

        return $this->isLaterThan($start) && $this->isEarlierThan($end);
    }

    /**
     * @param Hours $hours
     *
     * @return bool
     */
    public function isLaterThan(Hours $hours)
    {
        return $this->getValue() > $hours->getValue();
    }

    /**
     * @param Hours $hours
     *
     * @return bool
     */
    public function isEarlierThan(Hours $hours)
    {
        return $this->getValue() < $hours->getValue();
    }
}
