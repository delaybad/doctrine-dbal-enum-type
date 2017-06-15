<?php

namespace Tests;

use Vr\Doctrine\DBAL\Types\AbstractEnumType;

class StatusType extends AbstractEnumType
{
    const ENABLED   = 'enabled';

    const DISABLED  = 'disabled';

    const DELETED  = 'deleted';

    const UNVERIFED = 'unverifed';

    protected static $default = self::UNVERIFED;

    protected static $values = [
        self::ENABLED,
        self::DISABLED,
        self::DELETED,
        self::UNVERIFED
    ];

    public static function getEnabled()
    {
        return static::ENABLED;
    }

    public static function getDisabled()
    {
        return static::DISABLED;
    }

    public static function getDeleted()
    {
        return static::DELETED;
    }

    public static function getUnverifed()
    {
        return static::UNVERIFED;
    }
}