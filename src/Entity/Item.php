<?php

namespace App\Entity;

use App\Entity\Enums\MeasureTypeEnum;
use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $netPrice;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $grossPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $vatRate;

    /**
     * @ORM\Column(type="integer")
     */
    private $measure;

    /**
     * @var Invoice
     * @ORM\ManyToOne(targetEntity="Invoice", inversedBy="items")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    private $invoice;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getNetPrice(): ?float
    {
        return $this->netPrice;
    }

    /**
     * @param float $netPrice
     */
    public function setNetPrice(float $netPrice): void
    {
        $this->netPrice = $netPrice;
    }

    /**
     * @return float
     */
    public function getGrossPrice(): ?float
    {
        return $this->grossPrice;
    }

    /**
     * @param float $grossPrice
     */
    public function setGrossPrice(float $grossPrice): void
    {
        $this->grossPrice = $grossPrice;
    }

    /**
     * @return mixed
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * @param mixed $vatRate
     */
    public function setVatRate($vatRate): void
    {
        $this->vatRate = $vatRate;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * @param mixed $measure
     */
    public function setMeasure($measure): void
    {
        $this->measure = $measure;
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
    public function getMeasureName(): ?string
    {
        return $this->getMeasure() !== null ? MeasureTypeEnum::getStringFromValue($this->getMeasure()) : null;
    }
}
