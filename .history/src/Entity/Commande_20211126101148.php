<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups": {"read"}},
 * )
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Consommable::class)
     * @Groups({"read"})
     */
    private $consommabes;

    

    /**
     * @ORM\OneToOne(targetEntity=Table::class, cascade={"persist", "remove"})
     * @Groups({"read"})
     */
    private $table_;

    /**
     * @ORM\OneToOne(targetEntity=OrderState::class, cascade={"persist", "remove"})
     * @Groups({"read"})
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"read"})
     */
    private $date;

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

    

    public function getTable(): ?Table
    {
        return $this->table_;
    }

    public function setTable(?Table $table_): self
    {
        $this->table_ = $table_;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
