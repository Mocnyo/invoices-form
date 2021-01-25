<?php

namespace App\Form;

use App\Entity\Enums\MeasureTypeEnum;
use App\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Telewizor'
                ]
            ])
            ->add('quantity', NumberType::class, [
                'attr' => [
                    'placeholder' => '1'
                ]
            ])
            ->add('netPrice', NumberType::class, [
                'attr' => [
                    'placeholder' => '2100.99'
                ]
            ])
            ->add('grossPrice', TextType::class, [
                'attr' => [
                    'placeholder' => '2100.99'
                ]
            ])
            ->add('vatRate', NumberType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 27,
                    'placeholder' => '23'
                ],

            ])
            ->add('measure', ChoiceType::class, [
                'choices' => MeasureTypeEnum::getChoices(),
                'choice_label' => function ($value) {
                    return MeasureTypeEnum::getStringFromValue($value);
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Item::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'InvoiceItem';
    }
}