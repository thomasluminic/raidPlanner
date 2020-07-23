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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dayOne;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dayTwo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dayThree;


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

    public function getDayOne(): ?bool
    {
        return $this->dayOne;
    }

    public function setDayOne(?bool $dayOne): self
    {
        $this->dayOne = $dayOne;

        return $this;
    }

    public function getDayTwo(): ?bool
    {
        return $this->dayTwo;
    }

    public function setDayTwo(?bool $dayTwo): self
    {
        $this->dayTwo = $dayTwo;

        return $this;
    }

    public function getDayThree(): ?bool
    {
        return $this->dayThree;
    }

    public function setDayThree(?bool $dayThree): self
    {
        $this->dayThree = $dayThree;

        return $this;
    }




}
