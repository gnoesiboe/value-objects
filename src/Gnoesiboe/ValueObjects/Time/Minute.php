<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Minute
 */
final class Minute extends SingleValueObject implements ValueObjectInterface
{

    /** @var int */
    const MAX_VALUE = 59;

    /** @var int */
    const MIN_VALUE = 0;


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
     *
     * @throws DomainException
     */
    private function validateValue(Integer $value)
    {
        $this->validateIsMinutes($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     *
     * @throws DomainException
     */
    private function validateIsMinutes(Integer $value)
    {
        $this->throwDomainExceptionIf(
            $value->isLessThan(new Integer(self::MIN_VALUE)) || $value->isBiggerThan(new Integer(self::MAX_VALUE)),
            'Value should be between ' . self::MIN_VALUE . ' and ' . self::MAX_VALUE
        );
    }

    /**
     * @return \Gnoesiboe\ValueObjects\Numerical\Integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Minute $minutes
     *
     * @return bool
     *
     */
    public function isEqualTo(Minute $minutes)
    {
        return $minutes->getValue()->isEqualTo($this->getValue());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue()->__toString();
    }

    /**
     * @param Minute $start
     * @param Minute $end
     *
     * @return bool
     */
    public function isBetween(Minute $start, Minute $end)
    {
        if ($this->isEqualTo($start) === true || $this->isEqualTo($end) === true) {
            return true;
        }

        return $this->isLaterThan($start) && $this->isEarlierThan($end);
    }

    /**
     * @param Minute $minutes
     *
     * @return bool
     */
    public function isLaterThan(Minute $minutes)
    {
        return $this->getValue()->isBiggerThan($minutes->getValue());
    }

    /**
     * @param Minute $minutes
     *
     * @return bool
     */
    public function isEarlierThan(Minute $minutes)
    {
        return $this->getValue()->isLessThan($minutes->getValue());
    }
}
