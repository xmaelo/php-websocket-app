<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrderStateRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"task_name": "exact"})
 */
class OrderState
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
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="status")
     */
    private $ManyToOne;

    public function __construct()
    {
        $this->ManyToOne = new ArrayCollection();
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
     * @return Collection|Commande[]
     */
    public function getManyToOne(): Collection
    {
        return $this->ManyToOne;
    }

    public function addManyToOne(Commande $manyToOne): self
    {
        if (!$this->ManyToOne->contains($manyToOne)) {
            $this->ManyToOne[] = $manyToOne;
            $manyToOne->setStatus($this);
        }

        return $this;
    }

    public function removeManyToOne(Commande $manyToOne): self
    {
        if ($this->ManyToOne->removeElement($manyToOne)) {
            // set the owning side to null (unless already changed)
            if ($manyToOne->getStatus() === $this) {
                $manyToOne->setStatus(null);
            }
        }

        return $this;
    }

    
}
