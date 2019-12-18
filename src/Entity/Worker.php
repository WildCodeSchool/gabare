<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerRepository")
 */
class Worker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le prénom ne doit pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom ne doit pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le titre ne doit pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $function;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $portrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="workers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(?string $function): self
    {
        $this->function = $function;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPortrait(): ?string
    {
        return $this->portrait;
    }

    public function setPortrait(?string $portrait): self
    {
        $this->portrait = $portrait;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
