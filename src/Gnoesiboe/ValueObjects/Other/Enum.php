<?php

namespace Gnoesiboe\ValueObjects\Other;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Numerical\Integer;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class Enum
 */
abstract class Enum extends SingleValueObject implements ValueObjectInterface
{

    /**
     * @var \Gnoesiboe\ValueObjects\String\String
     */
    private $value;

    /**
     * @var array
     */
    private static $constants = array();

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    public function __construct(String $value)
    {
        $this->setValue($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     *
     * @throws DomainException
     */
    private function setValue(String $value)
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     *
     * @throws DomainException
     */
    private function validateValue(String $value)
    {
        $supportedValues = array_values(self::extractConstants(get_called_class()));

        foreach ($supportedValues as $supportedValue) {
            /** @var \Gnoesiboe\ValueObjects\String\String $supportedValue */

            if ($supportedValue->isEqualTo($value) === true) {
                return;
            }
        }

        throw new DomainException('Value not supported');
    }

    /**
     * @return array|\Gnoesiboe\ValueObjects\String\String[]
     */
    final public static function getSupported()
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

        $constants = array_map(function ($constant) {
            if (is_string($constant) === true) {
                return new String((string)$constant);
            } elseif (filter_var($constant, FILTER_VALIDATE_INT) !== false) {
                return new Integer($constant);
            } else {
                throw new \UnexpectedValueException('Type of constant not supported. Supported are integer and string, got: ' . var_export($constant, true));
            }

        }, $constants);

        self::$constants[$class] = array_values($constants);

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
     * @return \Gnoesiboe\ValueObjects\String\String
     */
    final public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    final public function __toString()
    {
        return $this->value->getValue();
    }

    /**
     * @param Enum $enum
     *
     * @return bool
     */
    final public function isEqualTo(Enum $enum)
    {
        return $this->getValue()->isEqualTo($enum->getValue());
    }
}
