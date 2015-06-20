<?php

namespace Gnoesiboe\ValueObjects\Numeric;

use Gnoesiboe\ValueObjects\Exception\DomainException;

/**
 * Class UnsignedInteger
 */
class UnsignedInteger extends Integer
{

    /**
     * @param int $value
     *
     * @throws DomainException
     */
    protected function validateValue($value)
    {
        parent::validateValue($value);

        $this->validateIsUnsingedInteger($value);
    }

    /**
     * @param int $value
     *
     * @throws DomainException
     */
    private function validateIsUnsingedInteger($value)
    {
        if ((int)$value < 0) {
            throw new DomainException('Value should be zero or more');
        }
    }
}
