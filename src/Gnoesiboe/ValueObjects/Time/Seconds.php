<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Seconds
 */
final class Seconds extends SingleValueObject implements ValueObjectInterface
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
        $this->validateIsSeconds($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     *
     * @throws DomainException
     */
    private function validateIsSeconds(Integer $value)
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
     * @param Seconds $seconds
     *
     * @return bool
     */
    public function isEqualTo(Seconds $seconds)
    {
        return $seconds->getValue()->isEqualTo($this->getValue());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue()->__toString();
    }

    /**
     * @param Seconds $start
     * @param Seconds $end
     *
     * @return bool
     */
    public function isBetween(Seconds $start, Seconds $end)
    {
        if ($this->isEqualTo($start) === true || $this->isEqualTo($end) === true) {
            return true;
        }

        return $this->isLaterThan($start) && $this->isEarlierThan($end);
    }

    /**
     * @param Seconds $seconds
     *
     * @return bool
     */
    public function isLaterThan(Seconds $seconds)
    {
        return $this->getValue()->isBiggerThan($seconds->getValue());
    }

    /**
     * @param Seconds $seconds
     *
     * @return bool
     */
    public function isEarlierThan(Seconds $seconds)
    {
        return $this->getValue()->isLessThan($seconds->getValue());
    }
}
