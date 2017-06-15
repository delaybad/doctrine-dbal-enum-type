# doctrine-abstract-enum-type

[![Packagist](https://img.shields.io/packagist/l/vr/doctrine-dbal-enum-type.svg)](https://packagist.org/packages/vr/doctrine-dbal-enum-type)
[![Latest stable](https://img.shields.io/packagist/v/vr/doctrine-dbal-enum-type.svg?style=flat-square)](https://packagist.org/packages/vr/doctrine-dbal-enum-type)


### Установка

Для установки использовать [composer](https://getcomposer.org/)

Выполнить `composer require vr/doctrine-dbal-enum-type`


### Пример

```php
<?php

namespace AppBundle\Doctrine\DBAL\Types;
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
```
