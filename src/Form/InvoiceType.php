<?php

namespace App\Form;

use App\Entity\Contractor;
use App\Entity\Enums\ContractorTypeEnum;
use App\Entity\Invoice;
use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeOfDocument', TextType::class, [
                'mapped' => false,
                'attr' => [
                    'disabled' => 'disabled',
                    'placeholder' => 'Faktura VAT'
                ]
            ])
            ->add('language', TextType::class, [
                'mapped' => false,
                'attr' => [
                    'disabled' => 'disabled',
                    'placeholder' => 'Polski'
                ]
            ])
            ->add('number', TextType::class)
            ->add('dateOfIssue', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('saleDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('placeOfIssue', TextType::class)
            ->add('seller', ContractorType::class, [
                'mapped' => false
            ])
            ->add('buyer', ContractorType::class, [
                'mapped' => false
            ])
            ->add('items', CollectionType::class, [
                'entry_type' => ItemType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'attr' => array(
                    'class' => 'item',
                ),
                'entry_options' => [
                    'label' => false
                ]
            ])
            ->add('payment', PaymentType::class, [
                'mapped' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Generuj'
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                /** @var Invoice $invoice */
                $invoice = $event->getForm()->getData();

                $seller = new Contractor();
                $seller->setName($data['seller']['name']);
                $seller->setAddress($data['seller']['address']);
                $seller->setCity($data['seller']['city']);
                $seller->setCode($data['seller']['code']);
                $seller->setNip($data['seller']['nip']);
                $seller->setSignature($data['seller']['signature']);
                $seller->setType(ContractorTypeEnum::SELLER);
                $seller->setInvoice($invoice);

                $buyer = new Contractor();
                $buyer->setName($data['buyer']['name']);
                $buyer->setAddress($data['buyer']['address']);
                $buyer->setCity($data['buyer']['city']);
                $buyer->setCode($data['buyer']['code']);
                $buyer->setNip($data['buyer']['nip']);
                $buyer->setSignature($data['buyer']['signature']);
                $buyer->setType(ContractorTypeEnum::BUYER);
                $buyer->setInvoice($invoice);

                $payment = new Payment();
                $payment->setInvoice($invoice);
                $payment->setMethod($data['payment']['method']);
                $payment->setStatus($data['payment']['status']);

                $invoice->setContractors([$seller, $buyer]);
                $invoice->setPayment($payment);
            })
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                /** @var Invoice $invoice */
                $invoice = $data;
                $items = $invoice->getItems();

                foreach ($items as $item) {
                    $item->setInvoice($invoice);
                }
            });
    }
}