<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampTrait;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    use TimeStampTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $placeOfIssue;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfIssue;

    /**
     * @ORM\Column(type="datetime")
     */
    private $saleDate;

    /**
     * @var Contractor[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Contractor", mappedBy="invoice", cascade={"persist","remove"})
     */
    private $contractors;

    /**
     * @var Item[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Item", mappedBy="invoice", cascade={"persist","remove"})
     */
    private $items;

    /**
     * @var Payment
     * @ORM\OneToOne(targetEntity="Payment", mappedBy="invoice", cascade={"persist","remove"})
     */
    private $payment;

    public function __toString()
    {
        return $this->getNumber();
    }

    public function __construct() {
        $this->contractors = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDateOfIssue(): ?\DateTimeInterface
    {
        return $this->dateOfIssue;
    }

    public function setDateOfIssue(\DateTimeInterface $dateOfIssue): self
    {
        $this->dateOfIssue = $dateOfIssue;

        return $this;
    }

    public function getSaleDate(): ?\DateTimeInterface
    {
        return $this->saleDate;
    }

    public function setSaleDate(\DateTimeInterface $saleDate): self
    {
        $this->saleDate = $saleDate;

        return $this;
    }

    /**
     * @return Contractor[]|ArrayCollection
     */
    public function getContractors()
    {
        return $this->contractors;
    }

    /**
     * @param Contractor[]|ArrayCollection $contractors
     */
    public function setContractors($contractors): void
    {
        $this->contractors = $contractors;
    }

    /**
     * @return Item[]|ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item[]|ArrayCollection $items
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }

    /**
     * @return Payment
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfIssue()
    {
        return $this->placeOfIssue;
    }

    /**
     * @param mixed $placeOfIssue
     */
    public function setPlaceOfIssue($placeOfIssue): void
    {
        $this->placeOfIssue = $placeOfIssue;
    }
}
