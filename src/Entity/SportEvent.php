<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SportEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportEventRepository::class)]
#[ApiResource]
class SportEvent
{
    /**
     * Identification number of event
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Name of the sport event
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * Description of the sport event
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * Amount that each person need to pay to participate in sport event
     */
    #[ORM\Column]
    private ?int $entryFee = null;

    /**
     * Popularity rating based on previous impressions of participants form 0 to 10
     */
    #[ORM\Column]
    private ?int $popularityRating = null;

    /**
     * Time when event was created
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * Flag that tells is event published
     */
    #[ORM\Column]
    private ?bool $isPublished = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEntryFee(): ?int
    {
        return $this->entryFee;
    }

    public function setEntryFee(int $entryFee): static
    {
        $this->entryFee = $entryFee;

        return $this;
    }

    public function getPopularityRating(): ?int
    {
        return $this->popularityRating;
    }

    public function setPopularityRating(int $popularityRating): static
    {
        $this->popularityRating = $popularityRating;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
