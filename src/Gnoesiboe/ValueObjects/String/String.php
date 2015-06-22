<?php

namespace Gnoesiboe\ValueObjects\String;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class String
 */
final class String extends SingleValueObject implements ValueObjectInterface
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
        $this->validateValueIsString($value);

        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @throws DomainException
     */
    private function validateValueIsString($value)
    {
        $this->throwDomainExceptionUnless(is_string($value), 'Value should be of type string');
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return strlen($this->value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $string
     *
     * @return bool
     */
    public function isAsLongAs(String $string)
    {
        return $this->getLength() === $string->getLength();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $string
     *
     * @return bool
     */
    public function isLongerThanOrAsLongAs(String $string)
    {
        return $this->isLongerThan($string) === true || $this->isAsLongAs($string) === true;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $string
     *
     * @return bool
     */
    public function isLongerThan(String $string)
    {
        return $this->getLength() > $string->getLength();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $string
     *
     * @return bool
     */
    public function isShorterThan(String $string)
    {
        return $this->getLength() < $string->getLength();
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $string
     *
     * @return bool
     */
    public function isShorterThanOrAsLongAs(String $string)
    {
        return $this->isShorterThan($string) === true || $this->isAsLongAs($string) === true;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $string
     *
     * @return bool
     */
    public function isEqualTo(String $string)
    {
        return $string->getValue() === $this->getValue();
    }

    /**
     * @return mixed
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
        return $this->value;
    }
}
