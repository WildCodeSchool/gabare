<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimetableRepository")
 */
class Timetable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date
     * @Assert\NotBlank()
     */
    private $visitDate;

    /**
     * @ORM\Column(type="time")
     * @Assert\Time
     * @Assert\NotBlank()
     */
    private $visitTime;

    /**
     * @return mixed
     */
    public function getVisitPlace()
    {
        return $this->visitPlace;
    }

    /**
     * @param mixed $visitPlace
     */
    public function setVisitPlace($visitPlace): void
    {
        $this->visitPlace = $visitPlace;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom du lieu ne doit pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $visitPlace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisitDate(): ?\DateTimeInterface
    {
        return $this->visitDate;
    }

    public function setVisitDate(\DateTimeInterface $visitDate): self
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    public function getVisitTime(): ?\DateTimeInterface
    {
        return $this->visitTime;
    }

    public function setVisitTime(\DateTimeInterface $visitTime): self
    {
        $this->visitTime = $visitTime;

        return $this;
    }
}
