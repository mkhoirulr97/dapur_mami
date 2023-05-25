<?php

// File: Menu.php

class Menu
{
    private $menu;
    private $picture;
    private $category;
    private $heavy;
    private $price;
    private $description;

    public function __construct($menu, $picture, $category, $heavy, $price, $description)
    {
        $this->menu = $menu;
        $this->picture = $picture;
        $this->category = $category;
        $this->heavy = $heavy;
        $this->price = $price;
        $this->description = $description;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getHeavy()
    {
        return $this->heavy;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
