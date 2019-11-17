<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable()
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     *
     */
    private $filename;
    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="products", fileNameProperty="filename")
     */
    private $imageFile;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $label;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isReservable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isWoman;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isChild;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isElectric;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LeasingProduct", mappedBy="idProduct")
     */
    private $leasingProducts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rate", inversedBy="products")
     */
    private $idRate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Model", inversedBy="idCategory")
     */
    private $idModel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $idCategory;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at;

    public function __construct()
    {
        $this->leasingProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Product
     */
    public function setFilename(?string $filename): Product
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Product
     * @throws Exception
     */
    public function setImageFile(?File $imageFile): Product
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile){
            $this->update_at = new \DateTime('now');
        }
        return $this;
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

    public function getIsReservable(): ?bool
    {
        return $this->isReservable;
    }

    public function setIsReservable(bool $isReservable): self
    {
        $this->isReservable = $isReservable;

        return $this;
    }

    public function getIsMan(): ?bool
    {
        return $this->isMan;
    }

    public function setIsMan(bool $isMan): self
    {
        $this->isMan = $isMan;

        return $this;
    }

    public function getIsWoman(): ?bool
    {
        return $this->isWoman;
    }

    public function setIsWoman(bool $isWoman): self
    {
        $this->isWoman = $isWoman;

        return $this;
    }

    public function getIsChild(): ?bool
    {
        return $this->isChild;
    }

    public function setIsChild(bool $isChild): self
    {
        $this->isChild = $isChild;

        return $this;
    }

    public function getIsElectric(): ?bool
    {
        return $this->isElectric;
    }

    public function setIsElectric(bool $isElectric): self
    {
        $this->isElectric = $isElectric;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            $leasingProduct->setIdProduct($this);
        }

        return $this;
    }

    public function removeLeasingProduct(LeasingProduct $leasingProduct): self
    {
        if ($this->leasingProducts->contains($leasingProduct)) {
            $this->leasingProducts->removeElement($leasingProduct);
            // set the owning side to null (unless already changed)
            if ($leasingProduct->getIdProduct() === $this) {
                $leasingProduct->setIdProduct(null);
            }
        }

        return $this;
    }

    public function getIdRate(): ?Rate
    {
        return $this->idRate;
    }

    public function setIdRate(?Rate $idRate): self
    {
        $this->idRate = $idRate;

        return $this;
    }

    public function getIdModel(): ?Model
    {
        return $this->idModel;
    }

    public function setIdModel(?Model $idModel): self
    {
        $this->idModel = $idModel;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Category $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }
}
