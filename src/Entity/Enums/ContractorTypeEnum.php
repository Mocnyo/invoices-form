<?php


namespace App\Entity\Enums;


use App\Exception\InvalidEnumValueException;

class ContractorTypeEnum extends BaseEnum
{
    const SELLER = 10;
    const BUYER = 20;

    public static function getStringFromValue($value)
    {
        switch ($value) {
            case self::SELLER:
                return "Sprzedawca";
            case self::BUYER:
                return "Nabywca";
            default:
                throw new InvalidEnumValueException("Enum of value $value does not exist.");
        }
    }
}