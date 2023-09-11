<?php

// function formatPrice($prix) {
//     $format = numfmt_create('fr_FR', NumberFormatter::CURRENCY);
//     echo numfmt_format_currency($format, $prix, "EUR");
// }

function priceExcludingVAT($prix)
{
    return (100 * $prix) / (100 + 20);
}
function discountedPrice($prix, $ristourne)
{
    return $prix - ($prix * $ristourne / 100);
}
function formatPrice($prix)
{
    echo number_format($prix, 2, ",", '') . " €";
}
// function calculTotal($prix, $quantite, $frais_port)
// {
//     return $prix * $quantite + $frais_port;
// }
function calculPrixTotal($cart, $frais_port)
{
    $total = 0;
    foreach ($cart as $cartproduct){
        $total = $total + $cartproduct['prix_ristourne'] * $cartproduct['quantite'];
    }
    return $total + $frais_port;
}
function calculPoidsTotal($cart)
{
    $total = 0;
    foreach ($cart as $cartproduct){
        $total = $total + $cartproduct['poids'] * $cartproduct["quantite"];
    }
    return $total;
}
$liste_transporteur =
    [
        "0" => [
            "id" => 1,
            "leger" => 3,
            "moyen" => 6,
            "lourd" => 1000,
        ],
        "1" => [
            "id" => 2,
            "leger" => 5,
            "moyen" => 10,
            "lourd" => 5692,
        ],
    ];
function calculFraisPort($cart, $choix_transporteur)
{
    calculPoidsTotal($cart);
    if ((int) calculPoidsTotal($cart) < (int) 500) {
        return (int) $choix_transporteur["leger"];
    } elseif ((int)calculPoidsTotal($cart) < (int) 2000) {
        return (int) $choix_transporteur["moyen"];
    } else {
        return (int) $choix_transporteur["lourd"];
    }
};

function getProducts()
{
    return [
        [
            "id" => 1,
            "nom" => "Vélo",
            "prix" => 1500,
            "poids" => 5500,
            "ristourne" => 10,
            "photo" => "images/velo.jpg",
        ],
        [
            "id" => 2,
            "nom" => "Trottinette",
            "prix" => 300,
            "poids" => 2500,
            "ristourne" => null,
            "photo" => "images/trottinette.jpg"
        ],
        [
            "id" => 3,
            "nom" => "Scooter",
            "prix" => 3000,
            "poids" => 50000,
            "ristourne" => 10,
            "photo" => "images/scooter.jpg"
        ],
        [
            "id" => 4,
            "nom" => "Draisienne",
            "prix" => 35,
            "poids" => 1000,
            "ristourne" => null,
            "photo" => "images/draisienne.jpg"
        ],
        [
            "id" => 5,
            "nom" => "Moto",
            "prix" => 15000,
            "poids" => 150000,
            "ristourne" => 5,
            "photo" => "images/moto.jpg",
        ],
    ];
}

function getProduct($id)
{
    $products = getProducts();
    foreach ($products as $product) {
        if ($product["id"] === $id) {
            return $product;
        }
    }
}

function ajoutPanier($nom, $quantite, $prix_ristourne, $produit_panier)
{
    $cart = getPanier();
    array_push($cart, ["nom" => $nom, "quantite" => $quantite, "poids" => $produit_panier["poids"], "prix_ristourne" => $prix_ristourne]);
    $_SESSION["cart"] = $cart;
}

function getPanier() {
    if (isset($_SESSION["cart"])){
        return $_SESSION["cart"];
    } else {
        return [];
    }
}

function emptyCart(){
    session_destroy();
    echo "Panier vidé !!";
}