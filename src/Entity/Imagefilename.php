<?php

namespace App\Entity;

use App\Repository\ImagefilenameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagefilenameRepository::class)]
class Imagefilename
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagefilename = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagefilename(): ?string
    {
        return $this->imagefilename;
    }

    public function setImagefilename(?string $imagefilename): static
    {
        $this->imagefilename = $imagefilename;

        return $this;
    }
}
