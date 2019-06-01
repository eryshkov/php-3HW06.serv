<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
    /**
     * @template "$firstName $lastName"
     *
     */
    public function getFullName(): string
    {
        $firstName = trim($this->firstName);
        $middleName = trim($this->middleName);
        $lastName = trim($this->lastName);
    
        //-------Start of search names at @template-------//
        $reflector = new \ReflectionMethod(self::class, 'getFullName');
        $docComment = $reflector->getDocComment();
        
        $regExp = '~@template.+"(\$[0-9A-Z]+)* *(\$[0-9A-Z]+)* *(\$[0-9A-Z]+)*"~mi';
        preg_match_all($regExp, $docComment, $matches, PREG_PATTERN_ORDER);
    
        if (null === array_shift($matches)) {
            throw new \LogicException('No matches found');
        }
    
        $validPieces = [];
        foreach ($matches as $pieceArray) {
            /** @var string $piece */
            $piece = str_replace('$', '', reset($pieceArray));
            if (!empty($piece) && !empty($$piece)) {
                $validPieces[] = $$piece;
            }
        }
        //-------End of search names at @template-------//
    
        if (empty($firstName) || empty($lastName)) {
            return $this->email;
        }
        
        if (!empty($firstName) && !empty($lastName)) {
            return implode(' ', $validPieces);
        }
    }
}
