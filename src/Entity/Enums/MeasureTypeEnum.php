<?php


namespace App\Entity\Enums;


use App\Exception\InvalidEnumValueException;

class MeasureTypeEnum extends BaseEnum
{
    const PSC = 10;
    const SVCS = 20;

    public static function getStringFromValue($value)
    {
        switch ($value) {
            case self::PSC:
                return "szt.";
            case self::SVCS:
                return "usł.";
            default:
                throw new InvalidEnumValueException("Enum of value $value does not exist.");
        }
    }
}