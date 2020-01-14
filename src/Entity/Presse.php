<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresseRepository")
 */
class Presse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max=255,
     *     maxMessage = "La video ne doit pas dépasser {{limit}} caractères")
     * @Assert\NotBlank()
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Le lien image ne doit pas dépasser {{limit}} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Le titre ne doit pas dépasser {{limit}} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Le titre ne doit pas dépasser {{limit}} caractères"
     * )
     * @Assert\NotBlank()
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
