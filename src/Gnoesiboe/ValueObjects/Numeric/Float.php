<?php

namespace Gnoesiboe\ValueObjects\Numeric;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Float
 */
final class Float extends ValueObject implements ValueObjectInterface
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
     * @param Float $float
     * @param int $depth
     *
     * @return bool
     */
    public function is(Float $float, $depth = 3)
    {
        return number_format($float->getValue(), $depth) === number_format($this->getValue(), $depth);
    }

    /**
     * @param Float $float
     *
     * @return bool
     */
    public function isLargerThan(Float $float)
    {
        return $this->getValue() > $float->getValue();
    }

    /**
     * @param Float $float
     * @param int $depth
     *
     * @return bool
     */
    public function isEqualToOrLargerThan(Float $float, $depth)
    {
        return $this->is($float, $depth) || $this->isLargerThan($float);
    }

    /**
     * @param Float $float
     *
     * @return bool
     */
    public function isLowerThan(Float $float)
    {
        return $this->getValue() < $float->getValue();
    }

    /**
     * @param Float $float
     * @param $depth
     *
     * @return bool
     */
    public function isEqualToOrLowerThan(Float $float, $depth)
    {
        return $this->is($float, $depth) || $this->isLowerThan($float);
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
