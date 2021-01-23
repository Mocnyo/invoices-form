<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContractorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nazwa Firmy'
                ]
            ])
            ->add('nip', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0009990009'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'ul. Potulicka 22'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Szczecin'
                ]
            ])
            ->add('code', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '70234'
                ]
            ])
            ->add('signature', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Jan Kowalski'
                ]
            ])

            ;
    }
}