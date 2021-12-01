<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups": {"read"}},
 * )
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"random": "exact", "task": "exact"})
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
     * @Groups({"read"})
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $random;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"read"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private $task;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private $object;

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

    

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getRandom(): ?string
    {
        return $this->random;
    }

    public function setRandom(string $random): self
    {
        $this->random = $random;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(?string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(?string $object): self
    {
        $this->object = $object;

        return $this;
    }
}
