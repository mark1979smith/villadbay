<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfigGroupRepository")
 */
class ConfigGroup
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Config", mappedBy="configGroup", orphanRemoval=true)
     */
    private $config_entries;

    public function __construct()
    {
        $this->config_entries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @return Collection|Config[]
     */
    public function getConfigEntries(): Collection
    {
        return $this->config_entries;
    }

    public function addConfigEntry(Config $configEntry): self
    {
        if (!$this->config_entries->contains($configEntry)) {
            $this->config_entries[] = $configEntry;
            $configEntry->setConfigGroup($this);
        }

        return $this;
    }

    public function removeConfigEntry(Config $configEntry): self
    {
        if ($this->config_entries->contains($configEntry)) {
            $this->config_entries->removeElement($configEntry);
            // set the owning side to null (unless already changed)
            if ($configEntry->getConfigGroup() === $this) {
                $configEntry->setConfigGroup(null);
            }
        }

        return $this;
    }
}
