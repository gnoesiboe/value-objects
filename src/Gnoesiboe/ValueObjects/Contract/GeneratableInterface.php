<?php

namespace Gnoesiboe\ValueObjects\Contract;

/**
 * Interface GeneratableInterface
 */
interface GeneratableInterface
{

    /**
     * @return static
     */
    public static function generate();
}
