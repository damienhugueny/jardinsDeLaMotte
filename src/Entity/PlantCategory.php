<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlantCategoryRepository")
 */
class PlantCategory
{
    public function __toString()
   {
           return $this->getname();
   }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plant", mappedBy="plantCategory")
     */
    private $plant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlantType", inversedBy="category")
     */
    private $plantType;

    public function __construct()
    {
        $this->plant = new ArrayCollection();
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

    /**
     * @return Collection|Plant[]
     */
    public function getPlant(): Collection
    {
        return $this->plant;
    }

    public function addPlant(Plant $plant): self
    {
        if (!$this->plant->contains($plant)) {
            $this->plant[] = $plant;
            $plant->setPlantCategory($this);
        }

        return $this;
    }

    public function removePlant(Plant $plant): self
    {
        if ($this->plant->contains($plant)) {
            $this->plant->removeElement($plant);
            // set the owning side to null (unless already changed)
            if ($plant->getPlantCategory() === $this) {
                $plant->setPlantCategory(null);
            }
        }

        return $this;
    }

    public function getPlantType(): ?PlantType
    {
        return $this->plantType;
    }

    public function setPlantType(?PlantType $plantType): self
    {
        $this->plantType = $plantType;

        return $this;
    }
}
