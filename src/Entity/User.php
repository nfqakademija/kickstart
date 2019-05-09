<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var null|\DateTime When password was changed
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $passwordChanged = null;

    /** @var bool Does plain password was entered */
    private $passwordWasChanged = false;

    /**
     * @var null|string Link to Personal Website
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $homepage = "";

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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /** Virtual method for EasyAdminBundle */
    public function getPlainPassword(): string
    {
        return ''; // We store passwords hashed, it is impossible to regenerate back
    }

    /** Virtual method for EasyAdminBundle */
    public function setPlainPassword($password): self
    {
        if (!$password) {
            return $this; // For usability: Empty password means do not change password
        }

        $this->passwordWasChanged = true;
        $hash = password_hash($password, PASSWORD_ARGON2I);
        return $this->setPassword($hash);
    }

    /**
     * @return bool
     */
    public function isPasswordWasChanged(): bool
    {
        return $this->passwordWasChanged;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return \DateTime|null
     */
    public function getPasswordChanged(): ?\DateTime
    {
        return $this->passwordChanged;
    }

    /**
     * @param \DateTime|null $passwordChanged
     */
    public function setPasswordChanged(?\DateTime $passwordChanged): self
    {
        $this->passwordChanged = $passwordChanged;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    /**
     * @param string|null $homepage
     */
    public function setHomepage(?string $homepage): self
    {
        $this->homepage = $homepage;

        return $this;
    }
}
