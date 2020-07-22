<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="characters")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Raid::class, mappedBy="userCharacter")
     */
    private $raids;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->raids = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Raid[]
     */
    public function getRaids(): Collection
    {
        return $this->raids;
    }

    public function addRaid(Raid $raid): self
    {
        if (!$this->raids->contains($raid)) {
            $this->raids[] = $raid;
            $raid->setUserCharacter($this);
        }

        return $this;
    }

    public function removeRaid(Raid $raid): self
    {
        if ($this->raids->contains($raid)) {
            $this->raids->removeElement($raid);
            // set the owning side to null (unless already changed)
            if ($raid->getUserCharacter() === $this) {
                $raid->setUserCharacter(null);
            }
        }

        return $this;
    }
}
