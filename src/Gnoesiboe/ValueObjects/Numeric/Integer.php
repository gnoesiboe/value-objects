<?php

namespace Gnoesiboe\ValueObjects\Numeric;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Integer
 */
class Integer extends ValueObject implements ValueObjectInterface
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
    protected function validateValue($value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new DomainException('Value should be of type int');
        }
    }

    /**
     * @param Integer $integer
     *
     * @return bool
     */
    public function isEqualTo(Integer $integer)
    {
        return $integer->getValue() === $this->getValue();
    }

    /**
     * @param Integer $integer
     *
     * @return bool
     */
    public function isBiggerThan(Integer $integer)
    {
        return $this->getValue() > $integer->getValue();
    }

    /**
     * @param Integer $integer
     *
     * @return bool
     */
    public function isBiggerThanOrEqualTo(Integer $integer)
    {
        return $this->isEqualTo($integer) === true || $this->isBiggerThan($integer) === true;
    }

    /**
     * @param Integer $integer
     *
     * @return bool
     */
    public function isLessThan(Integer $integer)
    {
        return $this->getValue() < $integer->getValue();
    }

    /**
     * @param Integer $integer
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
}
