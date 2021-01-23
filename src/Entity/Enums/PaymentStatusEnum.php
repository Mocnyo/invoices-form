<?php


namespace App\Entity\Enums;


use App\Exception\InvalidEnumValueException;

class PaymentStatusEnum extends BaseEnum
{
    const PAID = 10;
    const UNPAID = 20;

    public static function getStringFromValue($value)
    {
        switch ($value) {
            case self::PAID:
                return "Zapłacona";
            case self::UNPAID:
                return "Niezapłacona";
            default:
                throw new InvalidEnumValueException("Enum of value $value does not exist.");
        }
    }
}