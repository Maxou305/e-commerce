<?php

try{
    $mysqlConnection = new PDO(
    'mysql:host=localhost;
    dbname=ma_table;
    charset=utf8',
    'lpzkjdoi',
    'Mc110692'
    );
}
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

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

function getProducts($mysqlConnection)
{
    $tableStatement = $mysqlConnection->prepare('SELECT * FROM products');
    $tableStatement->execute();
    return $tableStatement->fetchAll();
}

function getProduct($id, $mysqlConnection)
{
    $products = getProducts($mysqlConnection);
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

function checkPanier($nom, $quantite,  $prix_ristourne, $produit_panier)
{
    $cart = getPanier();
    $newCart = [];
    $isUpdate = false;
    foreach ($cart as $cartProduct){
        if ($nom === $cartProduct["nom"]) {
            $isUpdate = true;
            $cartProduct["quantite"] += $quantite;
        }
        $newCart[] = $cartProduct;
    }
    if ($isUpdate) {
        // $_SESSION["cart"] = count($newCart) > 0 ? $newCart : $cart;
        if(count($newCart) > 0) {
            $_SESSION["cart"] = $newCart;
        } else {
            $_SESSION["cart"] = $cart;
        }
    } else {
        ajoutPanier($nom, $quantite, $prix_ristourne, $produit_panier);
    }
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
}



function displayItem(Item $item){
      echo '<div class="produit">
    <img src="' . $item->getImageUrl( ). '" alt="">
    <div>
        <h2>' . $item->getName() . '</h2>
        <p>' . $item->getDescription() . '</p>
        <p class="poids">Poids : ' . $item->getWheight() . ' g</p>
        <p class="prix-ttc">Prix TTC : ' . formatPrice($item->getPrice()) . '</p>
        <p class="ristourne">RISTOURNE : ' . $item->getDiscount() . '</p>
        <p class="prix-ristourne-ttc">Prix TTC après ristourne : . ' . formatPrice(discountedPrice($item->getPrice(), $item->getDiscount())) . ', ' . $item->getDiscount() . ')) ?></p>
        <form action="panier.php" method="POST">
            <div class="select">
                <label for="quantite">Quantité :</label>
                <select name="quantite" id="quantite">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <input type="hidden" name="id-panier" value="' . $item->getId() . '">
            <button class="cta">Commander</button>
        </form>
    </div>
</div>';

}

function displayCatalogue(Catalogue $catalogue){
    foreach ($catalogue->items as $item){
        displayItem($item);
    }
}

