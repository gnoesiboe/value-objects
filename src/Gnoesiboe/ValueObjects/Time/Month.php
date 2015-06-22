<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Month
 */
final class Month extends SingleValueObject implements ValueObjectInterface
{

    /** @var int */
    const MIN_VALUE = 1;

    /** @var int */
    const MAX_VALUE = 12;

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
        $this->validateIsMonth($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     */
    private function validateIsMonth(Integer $value)
    {
        $this->throwDomainExceptionUnless(
            $value->isLessThan(new Integer(self::MIN_VALUE)) || $value->isBiggerThan(new Integer(self::MAX_VALUE)),
            'The supplied value is an unvalid month'
        );
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isLaterThan(Month $month)
    {
        return $this->getValue()->isBiggerThan($month->getValue());
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
        return $this->getValue()->isEqualTo($month->getValue());
    }

    /**
     * @param Month $month
     *
     * @return bool
     */
    public function isEarlierThan(Month $month)
    {
        return $this->getValue()->isLessThan($month->getValue());
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
        return $this->value->__toString();
    }
}
