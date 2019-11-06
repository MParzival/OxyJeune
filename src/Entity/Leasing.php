<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeasingRepository")
 */
class Leasing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $rentalTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountPaid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountDeposit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LeasingProduct", mappedBy="idLeasing")
     */
    private $leasingProducts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="leasings")
     */
    private $idPerson;

    public function __construct()
    {
        $this->leasingProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getRentalTime(): ?int
    {
        return $this->rentalTime;
    }

    public function setRentalTime(int $rentalTime): self
    {
        $this->rentalTime = $rentalTime;

        return $this;
    }

    public function getAmountPaid(): ?int
    {
        return $this->amountPaid;
    }

    public function setAmountPaid(?int $amountPaid): self
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    public function getAmountDeposit(): ?int
    {
        return $this->amountDeposit;
    }

    public function setAmountDeposit(?int $amountDeposit): self
    {
        $this->amountDeposit = $amountDeposit;

        return $this;
    }

    /**
     * @return Collection|LeasingProduct[]
     */
    public function getLeasingProducts(): Collection
    {
        return $this->leasingProducts;
    }

    public function addLeasingProduct(LeasingProduct $leasingProduct): self
    {
        if (!$this->leasingProducts->contains($leasingProduct)) {
            $this->leasingProducts[] = $leasingProduct;
            $leasingProduct->setIdLeasing($this);
        }

        return $this;
    }

    public function removeLeasingProduct(LeasingProduct $leasingProduct): self
    {
        if ($this->leasingProducts->contains($leasingProduct)) {
            $this->leasingProducts->removeElement($leasingProduct);
            // set the owning side to null (unless already changed)
            if ($leasingProduct->getIdLeasing() === $this) {
                $leasingProduct->setIdLeasing(null);
            }
        }

        return $this;
    }

    public function getIdPerson(): ?Person
    {
        return $this->idPerson;
    }

    public function setIdPerson(?Person $idPerson): self
    {
        $this->idPerson = $idPerson;

        return $this;
    }
}
