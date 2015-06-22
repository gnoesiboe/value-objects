<?php

namespace Gnoesiboe\ValueObjects\Identity;

use Gnoesiboe\ValueObjects\Contract\GeneratableInterface;
use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\String\String;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;
use Rhumsaa\Uuid\Uuid as BaseUuid;

/**
 * Class GUID
 */
final class UUID extends SingleValueObject implements ValueObjectInterface, GeneratableInterface
{

    /**
     * @var string
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
        $this->validateValueMatchesUUIDPattern($value);

        $this->value = $value;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     *
     * @throws DomainException
     */
    private function validateValueMatchesUUIDPattern(String $value)
    {
        $match = preg_match('/' . BaseUuid::VALID_PATTERN . '/', $value->getValue());

        $this->throwDomainExceptionIf(is_int($match) === false || $match === 0, 'Pattern does not match valid UUID pattern');
    }

    /**
     * @return static
     */
    public static function generate()
    {
        return static::create(new String(BaseUuid::uuid4()));
    }

    /**
     * @return String
     */
    public function getValue()
    {
        return $this->value;
    }
}
