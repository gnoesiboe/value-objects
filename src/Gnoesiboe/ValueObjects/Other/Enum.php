<?php

namespace Gnoesiboe\ValueObjects\Other;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;

/**
 * Class Enum
 */
class Enum extends SingleValueObject implements ValueObjectInterface
{

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var array
     */
    private static $constants = array();

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param mixed $value
     *
     * @throws DomainException
     */
    private function setValue($value)
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @param mixed $value
     *
     * @throws DomainException
     */
    private function validateValue($value)
    {
        $supported = array_values(self::extractConstants(get_called_class()));

        $this->throwDomainExceptionIf(in_array($value, $supported, true) === false, 'Value should be one of: ' . implode(', ', $supported));
    }

    /**
     * @return array
     */
    public static function getSupported()
    {
        return self::extractConstants(get_called_class());
    }

    /**
     * @param string $class
     *
     * @return array
     */
    private static function extractConstants($class)
    {
        if (array_key_exists($class, self::$constants) === true) {
            return self::$constants[$class];
        }

        $reflection = new \ReflectionClass($class);

        $constants = $reflection->getConstants();

        self::validateClassConstantValuesAreUnique($constants);

        // This is required to make sure that constants of base classes will be the first to be checked
        // and then that if it's children
        while (($reflection = $reflection->getParentClass()) && $reflection->name !== __CLASS__) {
            $constants = $reflection->getConstants() + $constants;
        }

        self::$constants[$class] = $constants;

        return $constants;
    }

    /**
     * @param array $constants
     */
    private static function validateClassConstantValuesAreUnique(array $constants)
    {
        // values needs to be unique
        $ambiguous = array();

        foreach ($constants as $constantValue) {
            $nameOccurrenceForValue = array_keys($constants, $constantValue, true);

            if (count($nameOccurrenceForValue) > 1) {
                $ambiguous[var_export($constantValue, true)] = $nameOccurrenceForValue;
            }
        }

        if (count($ambiguous) > 0) {
            throw new \UnexpectedValueException('The constant values for an Enum need to be unique to be able to extinguish hem');
        }
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
        return (string)$this->getValue();
    }
}
