<?php

namespace Gnoesiboe\ValueObjects\Web;

use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class EmailAddress
 */
final class EmailAddress extends SingleValueObject implements ValueObjectInterface
{

    /**
     * @var \Gnoesiboe\ValueObjects\String\String
     */
    private $value;

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    public function __construct(String $value)
    {
        $this->setValue($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    private function setValue(String $value)
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    private function validateValue(String $value)
    {
        $this->validateIsEmail($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    private function validateIsEmail(String $value)
    {
        $this->throwDomainExceptionIf(
            filter_var($value->getValue(), FILTER_VALIDATE_EMAIL) === false,
            'Value should be a valid email address'
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value->__toString();
    }

    /**
     * @return \Gnoesiboe\ValueObjects\String\String
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
        return $this->getValue()->isEqualTo($emailAddress->getValue());
    }
}
