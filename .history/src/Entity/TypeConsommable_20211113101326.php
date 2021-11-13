<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeConsommableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TypeConsommableRepository::class)
 */
class TypeConsommable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $task_name;

    /**
     * @ORM\OneToMany(targetEntity=Consommable::class, mappedBy="type_id", orphanRemoval=true)
     */
    private $consommable_ids;

    public function __construct()
    {
        $this->consommable_ids = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTaskName(): ?string
    {
        return $this->task_name;
    }

    public function setTaskName(string $task_name): self
    {
        $this->task_name = $task_name;

        return $this;
    }

    /**
     * @return Collection|Consommable[]
     */
    public function getConsommableIds(): Collection
    {
        return $this->consommable_ids;
    }

    public function addConsommableId(Consommable $consommableId): self
    {
        if (!$this->consommable_ids->contains($consommableId)) {
            $this->consommable_ids[] = $consommableId;
            $consommableId->setTypeId($this);
        }

        return $this;
    }

    public function removeConsommableId(Consommable $consommableId): self
    {
        if ($this->consommable_ids->removeElement($consommableId)) {
            // set the owning side to null (unless already changed)
            if ($consommableId->getTypeId() === $this) {
                $consommableId->setTypeId(null);
            }
        }

        return $this;
    }
}
