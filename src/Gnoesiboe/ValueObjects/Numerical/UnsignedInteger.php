<?php

namespace Gnoesiboe\ValueObjects\Numerical;

use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;
use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;

/**
 * Class UnsignedInteger
 */
final class UnsignedInteger extends SingleValueObject implements ValueObjectInterface
{

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
        $this->validateIsUnsignedInteger($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\Numerical\Integer $value
     *
     * @throws DomainException
     */
    private function validateIsUnsignedInteger(Integer $value)
    {
        $this->throwDomainExceptionIf($value->isLessThan(new Integer(0)), 'Value should be zero or more');
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
