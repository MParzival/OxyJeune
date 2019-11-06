<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelRepository")
 */
class Model
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="models")
     */
    private $idBrand;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="idModel")
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getIdBrand(): ?Brand
    {
        return $this->idBrand;
    }

    public function setIdBrand(?Brand $idBrand): self
    {
        $this->idBrand = $idBrand;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getIdCategory(): Collection
    {
        return $this->idCategory;
    }

    public function addIdCategory(Product $idCategory): self
    {
        if (!$this->idCategory->contains($idCategory)) {
            $this->idCategory[] = $idCategory;
            $idCategory->setIdModel($this);
        }

        return $this;
    }

    public function removeIdCategory(Product $idCategory): self
    {
        if ($this->idCategory->contains($idCategory)) {
            $this->idCategory->removeElement($idCategory);
            // set the owning side to null (unless already changed)
            if ($idCategory->getIdModel() === $this) {
                $idCategory->setIdModel(null);
            }
        }

        return $this;
    }
}
