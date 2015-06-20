<?php

namespace Gnoesiboe\ValueObjects\Web;

use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class EmailAddress
 */
final class EmailAddress extends ValueObject implements ValueObjectInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param string $value
     */
    private function setValue($value)
    {
        $this->validateValue($value);

        $this->value = (string)$value;
    }

    /**
     * @param string $value
     */
    private function validateValue($value)
    {
        $this->validateIsString($value);
        $this->validateIsEmail($value);
    }

    /**
     * @param string $value
     */
    private function validateIsString($value)
    {
        $this->throwDomainExceptionUnless(is_string($value) === true, 'Value should be of type string');
    }

    /**
     * @param string $value
     */
    private function validateIsEmail($value)
    {
        $this->throwDomainExceptionIf(filter_var($value, FILTER_VALIDATE_EMAIL) === false, 'Value should be a valid email address');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param EmailAddress $emailAddress
     *
     * @return bool
     */
    public function isEqualTo(EmailAddress $emailAddress)
    {
        return $this->getValue() === $emailAddress->getValue();
    }
}
