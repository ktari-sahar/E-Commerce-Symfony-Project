<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $qte = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private ?string $prix = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'articles')]
    private Collection $categories;

    /**
     * @var Collection<int, Detailcommande>
     */
    #[ORM\OneToMany(targetEntity: Detailcommande::class, mappedBy: 'article')]
    private Collection $detailcommandes;

    /**
     * @var Collection<int, Detailfacture>
     */
    #[ORM\OneToMany(targetEntity: Detailfacture::class, mappedBy: 'article')]
    private Collection $detailfactures;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->detailcommandes = new ArrayCollection();
        $this->detailfactures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): static
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Detailcommande>
     */
    public function getDetailcommandes(): Collection
    {
        return $this->detailcommandes;
    }

    public function addDetailcommande(Detailcommande $detailcommande): static
    {
        if (!$this->detailcommandes->contains($detailcommande)) {
            $this->detailcommandes->add($detailcommande);
            $detailcommande->setArticle($this);
        }

        return $this;
    }

    public function removeDetailcommande(Detailcommande $detailcommande): static
    {
        if ($this->detailcommandes->removeElement($detailcommande)) {
            // set the owning side to null (unless already changed)
            if ($detailcommande->getArticle() === $this) {
                $detailcommande->setArticle(null);
            }
        }

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
            $detailfacture->setArticle($this);
        }

        return $this;
    }

    public function removeDetailfacture(Detailfacture $detailfacture): static
    {
        if ($this->detailfactures->removeElement($detailfacture)) {
            // set the owning side to null (unless already changed)
            if ($detailfacture->getArticle() === $this) {
                $detailfacture->setArticle(null);
            }
        }

        return $this;
    }
}
