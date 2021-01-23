<?php

namespace App\Form;

use App\Entity\Enums\PaymentMethodsEnum;
use App\Entity\Enums\PaymentStatusEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => PaymentStatusEnum::getChoices(),
                'choice_label' => function ($value) {
                    return PaymentStatusEnum::getStringFromValue($value);
                },
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('method', ChoiceType::class, [
                'choices' => PaymentMethodsEnum::getChoices(),
                'choice_label' => function ($value) {
                    return PaymentMethodsEnum::getStringFromValue($value);
                },
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ;
    }
}