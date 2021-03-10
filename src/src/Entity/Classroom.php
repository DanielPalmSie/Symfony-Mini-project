<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Classroom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_created;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    /**
     * @param bool|null $is_active
     * @return $this
     */
    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    /**
     * @param \DateTimeInterface|null $date_created
     * @return $this
     */
    public function setDateCreated(?\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    /******************** END Getters and Setters ********************/

    /**
     * @ORM\PrePersist
     *
     * @throws \Exception
     */
    public function onPrePersist()
    {
        $this->date_created = new \DateTime('now');
    }
}
