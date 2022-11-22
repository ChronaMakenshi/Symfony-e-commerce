<?php

namespace App\Entity;

use App\Repository\OrdersDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersDetailsRepository::class)]
class OrdersDetails
{
    #[ORM\Column(type: 'integer')]
    private $quatity;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Orders::class, inversedBy: 'ordersDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $orders;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Products::class, inversedBy: 'ordersDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $products;

    public function getQuatity(): ?int
    {
        return $this->quatity;
    }

    public function setQuatity(int $quatity): self
    {
        $this->quatity = $quatity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getProducts(): ?Products
    {
        return $this->products;
    }

    public function setProducts(?Products $products): self
    {
        $this->products = $products;

        return $this;
    }
}
