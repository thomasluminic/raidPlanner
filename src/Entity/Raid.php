<?php

namespace App\Entity;

use App\Repository\RaidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RaidRepository::class)
 */
class Raid
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="raids")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="raids")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCharacter;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUserCharacter(): ?Character
    {
        return $this->userCharacter;
    }

    public function setUserCharacter(?Character $userCharacter): self
    {
        $this->userCharacter = $userCharacter;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
