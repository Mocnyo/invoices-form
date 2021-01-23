<?php

namespace App\Entity;

use App\Entity\Enums\PaymentMethodsEnum;
use App\Entity\Enums\PaymentStatusEnum;
use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $method;

    /**
     * @var Invoice
     * @ORM\OneToOne(targetEntity="Invoice", inversedBy="payment")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    private $invoice;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     */
    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    /**
     * @return string|null
     * @throws \App\Exception\InvalidEnumValueException
     */
    public function getMethodName(): ?string
    {
        return $this->getMethod() !== null ? PaymentMethodsEnum::getStringFromValue($this->getMethod()) : null;
    }

    /**
     * @return string|null
     * @throws \App\Exception\InvalidEnumValueException
     */
    public function getStatusName(): ?string
    {
        return $this->getStatus() !== null ? PaymentStatusEnum::getStringFromValue($this->getStatus()) : null;
    }
}
