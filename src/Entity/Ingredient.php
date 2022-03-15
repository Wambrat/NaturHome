<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
     * @ORM\OneToMany(targetEntity=RecipeElement::class, mappedBy="ingredients")
     */
    private $recipeElements;

    public function __construct()
    {
        $this->recipeElements = new ArrayCollection();
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
            $recipeElement->setIngredients($this);
        }

        return $this;
    }

    public function removeRecipeElement(RecipeElement $recipeElement): self
    {
        if ($this->recipeElements->removeElement($recipeElement)) {
            // set the owning side to null (unless already changed)
            if ($recipeElement->getIngredients() === $this) {
                $recipeElement->setIngredients(null);
            }
        }

        return $this;
    }
}
