<?php

namespace App\Entity\Enums;

use App\Exception\InvalidEnumValueException;

abstract class BaseEnum
{
    public static function getChoices()
    {
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    public static function getLabel($value)
    {
        $choices = self::getChoices();
        $labels = array_flip($choices);

        if (! isset($labels[$value])) {
            throw new InvalidEnumValueException("Enum of value $value does not exist.");
        }

        return $labels[$value];
    }
}