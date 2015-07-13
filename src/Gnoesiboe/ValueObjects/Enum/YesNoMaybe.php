<?php

namespace Gnoesiboe\ValueObjects\Enum;

use Gnoesiboe\ValueObjects\Other\Enum;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class YesNoMaybe
 */
final class YesNoMaybe extends Enum
{

    /** @var string */
    const YES = 'yes';

    /** @var string */
    const NO = 'no';

    /** @var string */
    const MAYBE = 'maybe';

    /**
     * @return static
     */
    public static function createYes()
    {
        return self::create(new String(self::YES));
    }

    /**
     * @return static
     */
    public static function createNo()
    {
        return self::create(new String(self::NO));
    }

    /**
     * @return static
     */
    public static function createMaybe()
    {
        return self::create(new String(self::MAYBE));
    }
}
