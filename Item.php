<?php

include_once('fonctions/my-functions.php');

class Item {
    private int $id;
    private string $name;
    private string $description;
    private int $price;
    private ?string $imageUrl;
    private int $weight;
    private int $available;
    private int $quantity;
    private int $categories_id;
    private ?int $discount;
    public function __construct(int $id, string $name, string $description, int $price, ?string $imageUrl, int $weight, int $available, int $quantity, int $categories_id, ?int $discount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->weight = $weight;
        $this->available = $available;
        $this->quantity = $quantity;
        $this->categories_id = $categories_id;
        $this->discount = $discount;
    }

    public function getId() : int
    {
        return $this->id;
    }   
    public function getName() : string
    {
        return $this->name;
    }   
    public function getDescription() : string
    {
        return $this->description;
    }   
    public function getPrice() : int
    {
        return $this->price;
    }   
    public function getImageUrl()
    {
        return $this->imageUrl;
    }   
    public function getWheight()
    {
        return $this->weight;
    }   
    public function getAvailable()
    {
        return $this->available;
    }   
    public function getQuantity()
    {
        return $this->quantity;
    }   
    public function getCategories_id()
    {
        return $this->categories_id;
    }   
    public function getDiscount()
    {
        return $this->discount;
    }
}


