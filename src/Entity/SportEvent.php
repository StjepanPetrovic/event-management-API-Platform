<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Serializer\Filter\PropertyFilter;
use App\Repository\SportEventRepository;
use Carbon\Carbon;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use function Symfony\Component\String\u;

#[ORM\Entity(repositoryClass: SportEventRepository::class)]
#[ApiResource(
    description: 'Event where people can compete in various sports',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
    ],
    formats: [
        'jsonld',
        'json',
        'jsonhal',
        'html',
        'csv' => 'text/csv',
    ],
    normalizationContext: [
        'groups' => 'event:read',
    ],
    denormalizationContext: [
        'groups' => 'event:write',
    ],
    paginationItemsPerPage: 10,
)]
#[ApiFilter(PropertyFilter::class)]
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
    #[Groups(['event:read', 'event:write'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $name = null;

    /**
     * Description of the sport event
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['event:read'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $description = null;

    /**
     * Amount that each person need to pay to participate in sport event
     */
    #[ORM\Column]
    #[Groups(['event:read', 'event:write'])]
    #[ApiFilter(RangeFilter::class)]
    private ?int $entryFee = null;

    /**
     * Popularity rating based on previous impressions of participants form 0 to 10
     */
    #[ORM\Column]
    #[Groups(['event:read', 'event:write'])]
    private ?int $popularityRating = null;

    /**
     * Time when event was created
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt;

    /**
     * Flag that tells is event published
     */
    #[ORM\Column]
    #[Groups(['event:read', 'event:write'])]
    #[ApiFilter(BooleanFilter::class)]
    private bool $isPublished = false;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

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

    #[Groups(['event:read'])]
    public function getShortDescription(): ?string
    {
        return u($this->description)->truncate(40, '...');
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    #[Groups('event:write')]
    #[SerializedName('description')]
    public function setTextDescription(string $description): static
    {
        $this->description = nl2br($description);

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

    /**
     * Tells how much ago event is created in human-readable format
     */
    #[Groups(['event:read'])]
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->createdAt)->diffForHumans();
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
