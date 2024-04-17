<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, Purchaseline>
     */
    #[ORM\OneToMany(targetEntity: Purchaseline::class, mappedBy: 'product')]
    private Collection $purchaselines;

    public function __construct()
    {
        $this->purchaselines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Purchaseline>
     */
    public function getPurchaselines(): Collection
    {
        return $this->purchaselines;
    }

    public function addPurchaseline(Purchaseline $purchaseline): static
    {
        if (!$this->purchaselines->contains($purchaseline)) {
            $this->purchaselines->add($purchaseline);
            $purchaseline->setProduct($this);
        }

        return $this;
    }

    public function removePurchaseline(Purchaseline $purchaseline): static
    {
        if ($this->purchaselines->removeElement($purchaseline)) {
            // set the owning side to null (unless already changed)
            if ($purchaseline->getProduct() === $this) {
                $purchaseline->setProduct(null);
            }
        }

        return $this;
    }
}
