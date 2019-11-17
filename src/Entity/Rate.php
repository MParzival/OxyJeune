<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RateRepository")
 */
class Rate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
 * @ORM\Column(type="integer")
 */
    private $halfDayNumber;

    /**
     * @ORM\Column(type="float")
     */
    private $DayNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="idRate")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHalfDayNumber(): ?int
    {
        return $this->halfDayNumber;
    }

    public function setHalfDayNumber(int $halfDayNumber): self
    {
        $this->halfDayNumber = $halfDayNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDayNumber()
    {
        return $this->DayNumber;
    }

    /**
     * @param mixed $DayNumber
     * @return Rate
     */
    public function setDayNumber($DayNumber)
    {
        $this->DayNumber = $DayNumber;
        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setIdRate($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getIdRate() === $this) {
                $product->setIdRate(null);
            }
        }

        return $this;
    }
}
