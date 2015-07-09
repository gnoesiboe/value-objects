<?php

namespace Gnoesiboe\ValueObjects\Numerical;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Float
 */
final class Float extends SingleValueObject implements ValueObjectInterface
{

    /** @var int */
    const DEFAULT_DEPTH = 2;

    /**
     * @var float
     */
    private $value;

    /**
     * @param float $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param float $value
     */
    private function setValue($value)
    {
        $this->validateValueIsFloat($value);

        $this->value = $value;
    }

    /**
     * @param $value
     *
     * @throws DomainException
     */
    private function validateValueIsFloat($value)
    {
        $this->throwDomainExceptionIf(filter_var($value, FILTER_VALIDATE_FLOAT) === false, 'Value should be of type float');
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Float $float
     * @param int $depth
     *
     * @return bool
     */
    public function isEqualTo(Float $float, $depth = 3)
    {
        return number_format($float->getValue(), $depth) === number_format($this->getValue(), $depth);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Float $float
     *
     * @return bool
     */
    public function isBiggerThan(Float $float)
    {
        return $this->getValue() > $float->getValue();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Float $float
     * @param int $depth
     *
     * @return bool
     */
    public function isEqualToOrBiggerThan(Float $float, $depth)
    {
        return $this->isEqualTo($float, $depth) || $this->isBiggerThan($float);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Float $float
     *
     * @return bool
     */
    public function isLessThan(Float $float)
    {
        return $this->getValue() < $float->getValue();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Float $float
     * @param $depth
     *
     * @return bool
     */
    public function isEqualToOrLessThan(Float $float, $depth)
    {
        return $this->isEqualTo($float, $depth) || $this->isLessThan($float);
    }

    /**
     * @return float
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
        return $this->asString(self::DEFAULT_DEPTH);
    }

    /**
     * @param int $depth
     *
     * @return string
     */
    public function asString($depth = self::DEFAULT_DEPTH)
    {
        return number_format($this->getValue(), $depth);
    }
}
