<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Table::class, inversedBy="orders")
     */
    private $tableId;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="orders")
     */
    private $userId;

    /**
     * @ORM\ManyToMany(targetEntity=Consommable::class, inversedBy="orders")
     */
    private $consommableId;

    /**
     * @ORM\ManyToMany(targetEntity=OrderState::class, inversedBy="orders")
     */
    private $orderState;

    public function __construct()
    {
        $this->tableId = new ArrayCollection();
        $this->userId = new ArrayCollection();
        $this->consommableId = new ArrayCollection();
        $this->orderState = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Table[]
     */
    public function getTableId(): Collection
    {
        return $this->tableId;
    }

    public function addTableId(Table $tableId): self
    {
        if (!$this->tableId->contains($tableId)) {
            $this->tableId[] = $tableId;
        }

        return $this;
    }

    public function removeTableId(Table $tableId): self
    {
        $this->tableId->removeElement($tableId);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->userId->contains($userId)) {
            $this->userId[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->userId->removeElement($userId);

        return $this;
    }

    /**
     * @return Collection|Consommable[]
     */
    public function getConsommableId(): Collection
    {
        return $this->consommableId;
    }

    public function addConsommableId(Consommable $consommableId): self
    {
        if (!$this->consommableId->contains($consommableId)) {
            $this->consommableId[] = $consommableId;
        }

        return $this;
    }

    public function removeConsommableId(Consommable $consommableId): self
    {
        $this->consommableId->removeElement($consommableId);

        return $this;
    }

    /**
     * @return Collection|OrderState[]
     */
    public function getOrderState(): Collection
    {
        return $this->orderState;
    }

    public function addOrderState(OrderState $orderState): self
    {
        if (!$this->orderState->contains($orderState)) {
            $this->orderState[] = $orderState;
        }

        return $this;
    }

    public function removeOrderState(OrderState $orderState): self
    {
        $this->orderState->removeElement($orderState);

        return $this;
    }
}
