<?php

// File: MenuTest.php

use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    public function testMenuDetails()
    {
        $menu = 'Nasi Goreng';
        $picture = 'nasigoreng.jpg';
        $category = 'Makanan';
        $heavy = '300 gr';
        $price = 10000;
        $description = 'Nasi Goreng Spesial dengan berbagai toping';

        $menuObj = new Menu($menu, $picture, $category, $heavy, $price, $description);

        $this->assertEquals($menu, $menuObj->getMenu());
        $this->assertEquals($picture, $menuObj->getPicture());
        $this->assertEquals($category, $menuObj->getCategory());
        $this->assertEquals($heavy, $menuObj->getHeavy());
        $this->assertEquals($price, $menuObj->getPrice());
        $this->assertEquals($description, $menuObj->getDescription());
    }
}
