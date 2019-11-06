<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepairRepository")
 */
class Repair
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Quote", inversedBy="repairs")
     */
    private $idQuote;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdQuote(): ?Quote
    {
        return $this->idQuote;
    }

    public function setIdQuote(?Quote $idQuote): self
    {
        $this->idQuote = $idQuote;

        return $this;
    }
}
