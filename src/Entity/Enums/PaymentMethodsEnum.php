<?php


namespace App\Entity\Enums;


use App\Exception\InvalidEnumValueException;

class PaymentMethodsEnum extends BaseEnum
{
    const TRANSFER = 10;
    const CASH = 20;

    public static function getStringFromValue($value)
    {
        switch ($value) {
            case self::TRANSFER:
                return "Przelew";
            case self::CASH:
                return "Gotówka";
            default:
                throw new InvalidEnumValueException("Enum of value $value does not exist.");
        }
    }
}