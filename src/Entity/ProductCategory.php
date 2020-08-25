<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductCategoryRepository")
 */
class ProductCategory
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
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="productCategory")
     */
    private $product;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Origin", mappedBy="category")
     */
    private $origins;

  


    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->origins = new ArrayCollection();
       
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
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setProductCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->contains($product)) {
            $this->product->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getProductCategory() === $this) {
                $product->setProductCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Origin[]
     */
    public function getOrigins(): Collection
    {
        return $this->origins;
    }

    public function addOrigin(Origin $origin): self
    {
        if (!$this->origins->contains($origin)) {
            $this->origins[] = $origin;
            $origin->addCategory($this);
        }

        return $this;
    }

    public function removeOrigin(Origin $origin): self
    {
        if ($this->origins->contains($origin)) {
            $this->origins->removeElement($origin);
            $origin->removeCategory($this);
        }

        return $this;
    }

}
