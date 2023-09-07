<?php

// function formatPrice($prix) {
//     $format = numfmt_create('fr_FR', NumberFormatter::CURRENCY);
//     echo numfmt_format_currency($format, $prix, "EUR");
// }

function priceExcludingVAT($prix) {
    return (100 * $prix) / (100 + 20);
}
function discountedPrice($prix, $ristourne) {
    return $prix - ($prix * $ristourne / 100);
}
function formatPrice($prix) {
    echo number_format($prix, 2, ",", '')." €";
}
function calculTotal($prix, $quantite) {
    return $prix * $quantite;
}
function getProducts () {
    return [
        [
            "id" => 1,
            "nom" => "Vélo",
            "prix" => 1500,
            "poids" => 5.5,
            "ristourne" => 10,
            "photo" => "images/velo.jpg",
        ],
        [
            "id" => 2,
            "nom" => "Trottinette",
            "prix" => 300,
            "poids" => 2.5,
            "ristourne" => null,
            "photo" => "images/trottinette.jpg"
        ],
        [
            "id" => 3,
            "nom" => "Scooter",
            "prix" => 3000,
            "poids" => 50,
            "ristourne" => 10,
            "photo" => "images/scooter.jpg"
        ],
        [
            "id" => 4,
            "nom" => "Draisienne",
            "prix" => 35,
            "poids" => 1,
            "ristourne" => null,
            "photo" => "images/draisienne.jpg"
        ],
        [
            "id" => 5,
            "nom" => "Moto",
            "prix" => 15000,
            "poids" => 150,
            "ristourne" => 5,
            "photo" => "images/moto.jpg",
        ],
    ];
}

function getProduct($id){
    $products = getProducts();
    foreach ($products as $product) {
        if ($product["id"] === $id){
            return $product;
        }
    }
}