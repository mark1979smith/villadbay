<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $slug;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $opts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_read_only = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ConfigGroup", inversedBy="config_entries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $configGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getIsReadOnly(): ?bool
    {
        return $this->is_read_only;
    }

    public function setIsReadOnly(bool $is_read_only): self
    {
        $this->is_read_only = $is_read_only;

        return $this;
    }

    public function getConfigGroup(): ?ConfigGroup
    {
        return $this->configGroup;
    }

    public function setConfigGroup(?ConfigGroup $configGroup): self
    {
        $this->configGroup = $configGroup;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     *
     * @return Config
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOpts()
    {
        return $this->opts;
    }

    /**
     * @param mixed $opts
     *
     * @return Config
     */
    public function setOpts($opts)
    {
        $this->opts = $opts;

        return $this;
    }


    public function __toString(): string
    {
        return $this->getValue();
    }

}
