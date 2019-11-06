<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeasingProductRepository")
 */
class LeasingProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Leasing", inversedBy="leasingProducts")
     */
    private $idLeasing;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="leasingProducts")
     */
    private $idProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLeasing(): ?Leasing
    {
        return $this->idLeasing;
    }

    public function setIdLeasing(?Leasing $idLeasing): self
    {
        $this->idLeasing = $idLeasing;

        return $this;
    }

    public function getIdProduct(): ?Product
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Product $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }
}
