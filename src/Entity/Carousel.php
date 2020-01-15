<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarouselRepository")
 * @Vich\Uploadable
 */
class Carousel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\Length(
     *      max = 150,
     *      maxMessage = "Le titre ne doit pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Le lien ne doit pas dépasser {{limit}} caractères"
     * )
     */
    private $link;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @Vich\UploadableField(mapping="uploads_images", fileNameProperty="imageName")
     * @Assert\File(
     *     maxSize = "200k",
     *     mimeTypes = {"image/jpeg", "image/JPEG", "image/png", "image/PNG", "image/jpg", "image/JPG"},
     *     mimeTypesMessage = "Seuls les formats JEPG, JPG et PNG sont acceptés"
     * )
     * @var File|null
     */
    private $imageFile;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $imageName;
    /**
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    private $updatedAt;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new DateTime();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
