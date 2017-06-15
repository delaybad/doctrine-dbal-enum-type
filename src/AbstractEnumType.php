<?php

namespace Vr\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class AbstractEnumType extends Type
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected static $default = '';

    /**
     * @var array
     */
    protected static $values = [];

    /**
     * @var bool
     */
    protected static $isNull = false;

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return static::$values;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function hasValue($value): bool
    {
        return isset(static::$values[$value]) ?: false;
    }

    /**
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $result = "ENUM('".implode("', '", static::$values)."')";

        if (static::$isNull === false) {
            $result .= ' NOT NULL';
        }

        if(static::$default !== '' && in_array(static::$default, static::$values)) {
            $result .= " DEFAULT '" . static::$default . "'";
        }

        return $result;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        return $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!in_array($value, static::$values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid value %s from enum %s.',
                    $value,
                    $this->name
                )
            );
        }

        return $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name ?: array_search(get_class($this), self::getTypesMap(), true);
    }

    /**
     * @return string
     */
    public static function getDefault(): string
    {
        return static::$default;
    }
}
