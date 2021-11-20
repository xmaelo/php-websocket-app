<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ConsommableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Controller\OrderAction;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *   normalizationContext={"groups" = {"read"}},
 *   denormalizationContext={"groups" = {"write"}},
 *   collectionOperations={
 *     "get",
 *     "post" = {
 *       "controller" = OrderAction::class,
 *       "deserialize" = false,
 *       },
 *   },
 *   itemOperations={
 *     "get",
 *     "patch",
 *     "delete",
 *     "put",
 *   }
 * )
 */

class Consommable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    public $name;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */
    public $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    public $description;

    /**
    * @ORM\Column()
    * @Groups({"read"})
    * @ApiProperty(
    *   iri="http://schema.org/image",
    *   attributes={
    *     "openapi_context"={
    *       "type"="string",
    *     }
    *   }
    * )
    */
    public $picture;

    /**
     * @ORM\ManyToOne(targetEntity=TypeConsommable::class)
     * @Groups({"read"})
    */
    public $typeConsommable;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, mappedBy="consommableId")
     */
    public $orders;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *  @Groups({"read"})
     */
    public $status;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    

    public function getTypeConsommable(): ?TypeConsommable
    {
        return $this->typeConsommable;
    }

    public function setTypeConsommable(?TypeConsommable $typeConsommable): self
    {
        $this->typeConsommable = $typeConsommable;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->addConsommableId($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeConsommableId($this);
        }

        return $this;
    }


    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
