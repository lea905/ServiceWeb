<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReviewRepository;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource]
#[ApiResource(
    uriTemplate: '/estates/{id}/reviews',
    uriVariables: [
        'id' => new Link(fromClass: Estate::class, fromProperty: 'reviews'),
    ],
    operations: [new GetCollection()]
)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Estate $estate = null;

    #[ORM\Column]
    private ?int $score = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstate(): ?Estate
    {
        return $this->estate;
    }

    public function setEstate(?Estate $estate): static
    {
        $this->estate = $estate;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }
}
