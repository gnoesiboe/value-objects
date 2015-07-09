<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Year
 */
class Year extends SingleValueObject implements ValueObjectInterface
{

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
     */
    private function validateValue(Integer $value)
    {
        $this->validateIsYear($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     */
    private function validateIsYear(Integer $value)
    {
        $this->throwDomainExceptionUnless($value->isBiggerThanOrEqualTo(new Integer(self::MIN_VALUE)), 'The supplied value is an unvalid year');
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isLaterThan(Year $year)
    {
        return $this->getValue()->isBiggerThan($year->getValue());
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
        return $this->getValue()->isEqualTo($year->getValue());
    }

    /**
     * @param Year $year
     *
     * @return bool
     */
    public function isEarlierThan(Year $year)
    {
        return $this->getValue()->isLessThan($year->getValue());
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
        return $this->getValue()->__toString();
    }
}
