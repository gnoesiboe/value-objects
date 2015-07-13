<?php

namespace Gnoesiboe\ValueObjects\Enum;

use Gnoesiboe\ValueObjects\Other\Enum;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class CRUD
 */
final class CRUD extends Enum
{

    /** @var string */
    const CREATE = 'create';

    /** @var string */
    const READ = 'read';

    /** @var string */
    const UPDATE = 'update';

    /** @var string */
    const DELETE = 'delete';

    /**
     * @return static
     */
    public static function createCreate()
    {
        return self::create(new String(self::CREATE));
    }

    /**
     * @return static
     */
    public static function createRead()
    {
        return self::create(new String(self::READ));
    }

    /**
     * @return static
     */
    public static function createUpdate()
    {
        return self::create(new String(self::UPDATE));
    }

    /**
     * @return static
     */
    public static function createDelete()
    {
        return self::create(new String(self::DELETE));
    }
}
