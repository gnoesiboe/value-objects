<?php

namespace Gnoesiboe\ValueObjects\Enum;

use Gnoesiboe\ValueObjects\Other\Enum;

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
}
