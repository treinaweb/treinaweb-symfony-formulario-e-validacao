<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\HasString;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(
     *      min = 50,
     *      minMessage = "length.min"
     * )
     * @HasString(
     *      string = "Elton"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="task.description.not_blank")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="not_blank")
     * @Assert\GreaterThanOrEqual("today", message= "task.scheduling.greater_than_or_equal")
     * @Assert\DateTime(message="date_time")
     */
    private $scheduling;

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

    public function getScheduling(): ?\DateTimeInterface
    {
        return $this->scheduling;
    }

    public function setScheduling(\DateTimeInterface $scheduling): self
    {
        $this->scheduling = $scheduling;

        return $this;
    }
}
