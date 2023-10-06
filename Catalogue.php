<?php

include_once('fonctions/my-functions.php');
include_once('Item.php');


class Catalogue {
    public $items = [];

    public function __construct($mysqlConnection)
    {
       $products = getProducts($mysqlConnection);

        foreach($products as $product) {
            $this->items[] = new Item(
                $product['id'],
                $product['name'],
                $product['description'],
                $product['price'],
                $product['image'],
                $product['weight'],
                $product['available'],
                $product['quantity'],
                $product['categories_id'],
                $product['discount']
            );
        }
    }
    
    public function getItems(){
        return $this->items;
    }
}
