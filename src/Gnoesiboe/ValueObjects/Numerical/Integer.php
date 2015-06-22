<?php

namespace Gnoesiboe\ValueObjects\Numerical;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Integer
 */
final class Integer extends SingleValueObject implements ValueObjectInterface
{

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
     *
     * @throws DomainException
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
        $this->throwDomainExceptionIf(
            filter_var($value, FILTER_VALIDATE_INT) === false,
            'Value should be of type int'
        );
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $integer
     *
     * @return bool
     */
    public function isEqualTo(Integer $integer)
    {
        return $integer->getValue() === $this->getValue();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $integer
     *
     * @return bool
     */
    public function isBiggerThan(Integer $integer)
    {
        return $this->getValue() > $integer->getValue();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $integer
     *
     * @return bool
     */
    public function isBiggerThanOrEqualTo(Integer $integer)
    {
        return $this->isEqualTo($integer) === true || $this->isBiggerThan($integer) === true;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $integer
     *
     * @return bool
     */
    public function isLessThan(Integer $integer)
    {
        return $this->getValue() < $integer->getValue();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $integer
     *
     * @return bool
     */
    public function isLessThanOrEqualTo(Integer $integer)
    {
        return $this->isEqualTo($integer) === true || $this->isLessThan($integer) === true;
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
