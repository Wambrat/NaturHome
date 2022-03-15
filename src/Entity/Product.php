<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $recipe;

    /**
     * @ORM\OneToMany(targetEntity=RecipeElement::class, mappedBy="product")
     */
    private $recipeElements;

    /**
     * @ORM\OneToMany(targetEntity=MaterialsGroup::class, mappedBy="product")
     */
    private $materialsGroups;

    public function __construct()
    {
        $this->recipeElements = new ArrayCollection();
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

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(?string $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * @return Collection<int, RecipeElement>
     */
    public function getRecipeElements(): Collection
    {
        return $this->recipeElements;
    }

    public function addRecipeElement(RecipeElement $recipeElement): self
    {
        if (!$this->recipeElements->contains($recipeElement)) {
            $this->recipeElements[] = $recipeElement;
            $recipeElement->setProduct($this);
        }

        return $this;
    }

    public function removeRecipeElement(RecipeElement $recipeElement): self
    {
        if ($this->recipeElements->removeElement($recipeElement)) {
            // set the owning side to null (unless already changed)
            if ($recipeElement->getProduct() === $this) {
                $recipeElement->setProduct(null);
            }
        }

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
            $materialsGroup->setProduct($this);
        }

        return $this;
    }

    public function removeMaterialsGroup(MaterialsGroup $materialsGroup): self
    {
        if ($this->materialsGroups->removeElement($materialsGroup)) {
            // set the owning side to null (unless already changed)
            if ($materialsGroup->getProduct() === $this) {
                $materialsGroup->setProduct(null);
            }
        }

        return $this;
    }
}
