<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\Collection;
use App\Repository\SousCategoriesRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich; 

#[ORM\Entity(repositoryClass: SousCategoriesRepository::class)]
class SousCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $souscategoriesorders = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\OneToMany(mappedBy: 'sousCategories', targetEntity: Products::class)]
    private $products;

    #[ORM\ManyToOne(inversedBy: 'sousCategories')]
    private ?Categories $parent = null;

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

    public function getSouscategoriesorders(): ?int
    {
        return $this->souscategoriesorders;
    }

    public function setSouscategoriesorders(int $souscategoriesorders): self
    {
        $this->souscategoriesorders = $souscategoriesorders;

        return $this;
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

    public function getParent(): ?Categories
    {
        return $this->parent;
    }

    public function setParent(?Categories $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
    
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

     /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setSousCategories($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getSousCategories() === $this) {
                $product->setSousCategories(null);
            }
        }

        return $this;
    }
}
