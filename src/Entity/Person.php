<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $cellNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="people")
     */
    private $idAddress;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quote", mappedBy="idPerson")
     */
    private $quotes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Leasing", mappedBy="idPerson")
     */
    private $leasings;

    public function __construct()
    {
        $this->quotes = new ArrayCollection();
        $this->leasings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCellNumber(): ?string
    {
        return $this->cellNumber;
    }

    public function setCellNumber(string $cellNumber): self
    {
        $this->cellNumber = $cellNumber;

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

    public function getIdAddress(): ?Address
    {
        return $this->idAddress;
    }

    public function setIdAddress(?Address $idAddress): self
    {
        $this->idAddress = $idAddress;

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes[] = $quote;
            $quote->setIdPerson($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->contains($quote)) {
            $this->quotes->removeElement($quote);
            // set the owning side to null (unless already changed)
            if ($quote->getIdPerson() === $this) {
                $quote->setIdPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Leasing[]
     */
    public function getLeasings(): Collection
    {
        return $this->leasings;
    }

    public function addLeasing(Leasing $leasing): self
    {
        if (!$this->leasings->contains($leasing)) {
            $this->leasings[] = $leasing;
            $leasing->setIdPerson($this);
        }

        return $this;
    }

    public function removeLeasing(Leasing $leasing): self
    {
        if ($this->leasings->contains($leasing)) {
            $this->leasings->removeElement($leasing);
            // set the owning side to null (unless already changed)
            if ($leasing->getIdPerson() === $this) {
                $leasing->setIdPerson(null);
            }
        }

        return $this;
    }
}
