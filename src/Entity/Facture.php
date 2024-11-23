<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 3, nullable: true)]
    private ?string $ttc = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    /**
     * @var Collection<int, Detailfacture>
     */
    #[ORM\OneToMany(targetEntity: Detailfacture::class, mappedBy: 'facture')]
    private Collection $detailfactures;

    public function __construct()
    {
        $this->detailfactures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTtc(): ?string
    {
        return $this->ttc;
    }

    public function setTtc(?string $ttc): static
    {
        $this->ttc = $ttc;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Detailfacture>
     */
    public function getDetailfactures(): Collection
    {
        return $this->detailfactures;
    }

    public function addDetailfacture(Detailfacture $detailfacture): static
    {
        if (!$this->detailfactures->contains($detailfacture)) {
            $this->detailfactures->add($detailfacture);
            $detailfacture->setFacture($this);
        }

        return $this;
    }

    public function removeDetailfacture(Detailfacture $detailfacture): static
    {
        if ($this->detailfactures->removeElement($detailfacture)) {
            // set the owning side to null (unless already changed)
            if ($detailfacture->getFacture() === $this) {
                $detailfacture->setFacture(null);
            }
        }

        return $this;
    }
}
