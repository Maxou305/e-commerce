<?php
include('fonctions/my-functions.php');
include('templates/header.php');

// // Traitement de formulaire 
if (isset($_POST['id-panier'])){
    $product_id  = (int) $_POST['id-panier'];
    $produit_panier = getProduct($product_id, $mysqlConnection);
    $quantite = (int)$_POST["quantite"];
    $prix = $produit_panier['price'];
    $ristourne = $produit_panier['discount'];
    $prix_ristourne = discountedPrice($prix, $ristourne);
    $nom = $produit_panier['name'];
    checkPanier($nom, $quantite, $prix_ristourne, $produit_panier);
}

$cart = getPanier();

if (isset($_POST['transporteur'])){
    $transporteur_id = (int)$_POST['transporteur'];
    $choix_transporteur = $liste_transporteur[$transporteur_id];
    $frais_port = (int) calculFraisPort($cart, $choix_transporteur);
} else {
    $frais_port = 0;
}

$total = calculPrixTotal($cart, $frais_port);
$totalHT = priceExcludingVAT($total);
$tva = $total - $totalHT;

if (isset($_POST["vide-panier"])){
    emptyCart();
}
?>

<div class="box-tableau">
    <table class="tableau">
        <thead>
            <th>
                Produit
            </th>
            <th>
                Prix unitaire
            </th>
            <th>
                Quantité
            </th>
            <th>
                Total
            </th>
        </thead>
        <tbody>
            <?php foreach ($cart as $cartItem) :?>
                <tr>
                    <td>
                        <?php echo $cartItem["nom"];?>
                    </td>                    
                    <td>
                        <?php echo formatPrice($cartItem["prix_ristourne"]) ?>
                    </td>
                    <td>
                        <?php echo $cartItem["quantite"] ?>
                    </td>
                    <td>
                        <?php echo formatPrice($cartItem["prix_ristourne"] * $cartItem["quantite"]) ?>
                    </td>
                </tr>
            <?php endforeach?>
            <tr>
                <td> </td>
                <td> </td>
                <td>Total HT</td>
                <td><?php echo formatPrice($totalHT) ?></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td>TVA</td>
                <td><?php echo formatPrice($tva) ?></td>
            </tr>
            <tr>
                <td>
                    <label for="transport">Choix du transporteur :</label>
                </td>
                <form action="panier.php" method="POST">
                    <td>
                        <select name="transporteur" id="transporteur">
                            <option value="" selected>---</option>
                            <option value="0">MassimO Inc.</option>
                            <option value="1">Soumeya Presto</option>
                        </select>
                    </td>
                    <td colspan="2">
                        <button class="cta-panier">Valider</button>
                    </td>
                </form>
            </tr>
            <tr>
                <td> <?php var_dump($cart) ?> </td>
                <td> </td>
                <td>Transport</td>
                <td><?php echo formatPrice($frais_port) ?></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td class="cellule-total">TOTAL TTC</td>
                <td class="cellule-total"><?php echo formatPrice($total) ?></td>
            </tr>
        </tbody>
    </table>
</div>
<form action="" method="POST">
    <input class="vide-panier" type="submit" name="vide-panier" value="Vider le panier">
</form>


<?php include('templates/footer.php'); ?>
