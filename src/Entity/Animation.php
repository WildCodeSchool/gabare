<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimationRepository")
 */
class Animation
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $schedule;

    /**
     * @ORM\Column(type="time")
     */
    private $hourStart;

    /**
     * @ORM\Column(type="time")
     */
    private $hourEnd;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getHourStart(): ?\DateTimeInterface
    {
        return $this->hourStart;
    }

    public function setHourStart(\DateTimeInterface $hourStart): self
    {
        $this->hourStart = $hourStart;

        return $this;
    }

    public function getHourEnd(): ?\DateTimeInterface
    {
        return $this->hourEnd;
    }

    public function setHourEnd(\DateTimeInterface $hourEnd): self
    {
        $this->hourEnd = $hourEnd;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
