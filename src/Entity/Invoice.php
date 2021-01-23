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
     * @ORM\Column(type="datetime")
     */
    private $dateOfIssue;

    /**
     * @ORM\Column(type="datetime")
     */
    private $saleDate;

    /**
     * @var Contractor[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Contractor", mappedBy="invoice")
     */
    private $contractor;

    /**
     * @var Item[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Item", mappedBy="invoice")
     */
    private $item;

    /**
     * @var Payment
     * @ORM\OneToOne(targetEntity="Payment", mappedBy="invoice")
     */
    private $payment;

    public function __construct() {
        $this->contractor = new ArrayCollection();
        $this->item = new ArrayCollection();
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
}
