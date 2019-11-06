<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuoteRepository")
 */
class Quote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $label;

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
    private $repairTime;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $priceHt;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $priceTva;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="quotes")
     */
    private $idPerson;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Repair", mappedBy="idQuote")
     */
    private $repairs;

    public function __construct()
    {
        $this->repairs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
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

    public function getRepairTime(): ?int
    {
        return $this->repairTime;
    }

    public function setRepairTime(int $repairTime): self
    {
        $this->repairTime = $repairTime;

        return $this;
    }

    public function getPriceHt(): ?string
    {
        return $this->priceHt;
    }

    public function setPriceHt(string $priceHt): self
    {
        $this->priceHt = $priceHt;

        return $this;
    }

    public function getPriceTva(): ?string
    {
        return $this->priceTva;
    }

    public function setPriceTva(string $priceTva): self
    {
        $this->priceTva = $priceTva;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

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

    /**
     * @return Collection|Repair[]
     */
    public function getRepairs(): Collection
    {
        return $this->repairs;
    }

    public function addRepair(Repair $repair): self
    {
        if (!$this->repairs->contains($repair)) {
            $this->repairs[] = $repair;
            $repair->setIdQuote($this);
        }

        return $this;
    }

    public function removeRepair(Repair $repair): self
    {
        if ($this->repairs->contains($repair)) {
            $this->repairs->removeElement($repair);
            // set the owning side to null (unless already changed)
            if ($repair->getIdQuote() === $this) {
                $repair->setIdQuote(null);
            }
        }

        return $this;
    }
}
