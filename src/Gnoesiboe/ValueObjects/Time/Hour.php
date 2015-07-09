<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Hour
 */
final class Hour extends SingleValueObject implements ValueObjectInterface
{

    /** @var int */
    const MAX_VALUE = 23;

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
        $this->validateIsHours($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     *
     * @throws DomainException
     */
    private function validateIsHours(Integer $value)
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
     * @param Hour $hours
     *
     * @return bool
     */
    public function isEqualTo(Hour $hours)
    {
        return $hours->getValue()->isEqualTo($this->getValue());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue()->__toString();
    }

    /**
     * @param Hour $start
     * @param Hour $end
     *
     * @return bool
     */
    public function isBetween(Hour $start, Hour $end)
    {
        if ($this->isEqualTo($start) === true || $this->isEqualTo($end) === true) {
            return true;
        }

        return $this->isLaterThan($start) && $this->isEarlierThan($end);
    }

    /**
     * @param Hour $hours
     *
     * @return bool
     */
    public function isLaterThan(Hour $hours)
    {
        return $this->getValue()->isBiggerThan($hours->getValue());
    }

    /**
     * @param Hour $hours
     *
     * @return bool
     */
    public function isEarlierThan(Hour $hours)
    {
        return $this->getValue()->isLessThan($hours->getValue());
    }
}
