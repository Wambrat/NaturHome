<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=MaterialsGroup::class, mappedBy="equipment")
     */
    private $materialsGroups;

    public function __construct()
    {
        $this->materialsGroups = new ArrayCollection();
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
     * @return Collection<int, MaterialsGroup>
     */
    public function getMaterialsGroups(): Collection
    {
        return $this->materialsGroups;
    }

    public function addMaterialsGroup(MaterialsGroup $materialsGroup): self
    {
        if (!$this->materialsGroups->contains($materialsGroup)) {
            $this->materialsGroups[] = $materialsGroup;
            $materialsGroup->setEquipment($this);
        }

        return $this;
    }

    public function removeMaterialsGroup(MaterialsGroup $materialsGroup): self
    {
        if ($this->materialsGroups->removeElement($materialsGroup)) {
            // set the owning side to null (unless already changed)
            if ($materialsGroup->getEquipment() === $this) {
                $materialsGroup->setEquipment(null);
            }
        }

        return $this;
    }
}
