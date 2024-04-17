<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
class Purchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_created = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_updated = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'purchases')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Purchaseline>
     */
    #[ORM\OneToMany(targetEntity: Purchaseline::class, mappedBy: 'purchase')]
    private Collection $purchaselines;

    public function __construct()
    {
        $this->purchaselines = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->date_updated;
    }

    public function setDateUpdated(\DateTimeInterface $date_updated): static
    {
        $this->date_updated = $date_updated;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

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
            $purchaseline->setPurchase($this);
        }

        return $this;
    }

    public function removePurchaseline(Purchaseline $purchaseline): static
    {
        if ($this->purchaselines->removeElement($purchaseline)) {
            // set the owning side to null (unless already changed)
            if ($purchaseline->getPurchase() === $this) {
                $purchaseline->setPurchase(null);
            }
        }

        return $this;
    }
}
