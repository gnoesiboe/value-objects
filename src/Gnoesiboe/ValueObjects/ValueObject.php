<?php

namespace Gnoesiboe\ValueObjects;

use Gnoesiboe\ValueObjects\Exception\DomainException;

/**
 * Class ValueObject
 */
abstract class ValueObject
{

    /**
     * @param mixed $condition
     * @param string|null $message
     *
     * @throws DomainException
     */
    protected function throwDomainExceptionUnless($condition, $message = null)
    {
        if ((bool)$condition === false) {
            throw new DomainException($message);
        }
    }

    /**
     * @param mixed $condition
     * @param null $message
     *
     * @throws DomainException
     */
    protected function throwDomainExceptionIf($condition, $message = null)
    {
        if ((bool)$condition === true) {
            throw new DomainException($message);
        }
    }
}
