<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Consommable::class)
     */
    private $consommabes;

    /**
     * @ORM\ManyToOne(targetEntity=OrderState::class, inversedBy="ManyToOne")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity=Table::class, cascade={"persist", "remove"})
     */
    private $table_;

    public function __construct()
    {
        $this->consommabes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Consommable[]
     */
    public function getConsommabes(): Collection
    {
        return $this->consommabes;
    }

    public function addConsommabe(Consommable $consommabe): self
    {
        if (!$this->consommabes->contains($consommabe)) {
            $this->consommabes[] = $consommabe;
        }

        return $this;
    }

    public function removeConsommabe(Consommable $consommabe): self
    {
        $this->consommabes->removeElement($consommabe);

        return $this;
    }

    public function getStatus(): ?OrderState
    {
        return $this->status;
    }

    public function setStatus(?OrderState $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTable(): ?Table
    {
        return $this->table_;
    }

    public function setTable(?Table $table_): self
    {
        $this->table_ = $table_;

        return $this;
    }
}
