<?php
include('fonctions/my-functions.php');

// // Traitement de formulaire 
$product_id  = (int) $_POST['id-panier'];
$produit_panier = getProduct($product_id);
$quantite = (int)$_POST["quantite"];
$prix = $produit_panier['prix'];
$ristourne = $produit_panier['ristourne'];
$prix_ristourne = discountedPrice($prix, $ristourne);
$nom = $produit_panier['nom'];

if (isset($_POST['transporteur'])){
    $transporteur_id = (int)$_POST['transporteur'];
    $choix_transporteur = $liste_transporteur[$transporteur_id];
    $frais_port = (int) calculFraisPort($produit_panier, $choix_transporteur, $quantite);
} else {
    $frais_port = 0;
}

$total = calculTotal($prix_ristourne, $quantite, $frais_port);
$totalHT = priceExcludingVAT($total);
$tva = $total - $totalHT;

include('templates/header.php');
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
            <tr>
                <td><?php echo $nom ?></td>
                <td><?php echo formatPrice($prix_ristourne) ?></td>
                <td><?php echo $quantite ?></td>
                <td><?php echo formatPrice($total) ?></td>
            </tr>
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
                    <input type="hidden" name="id-panier" id="id-panier" value="<?php echo $_POST['id-panier'] ?>"/>
                    <input type="hidden" name="quantite" id="quantite" value="<?php echo $_POST['quantite'] ?>" />
                    <td>
                        <select name="transporteur" id="transporteur">
                            <option value="" selected>---</option>
                            <option value="0">La Poste</option>
                            <option value="1">Soumeya Presto</option>
                        </select>
                    </td>
                    <td colspan="2">
                        <button class="cta-panier">Valider</button>
                    </td>
                </form>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td>Transport</td>
                <td><?php echo $frais_port ?></td>
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



<?php include('templates/footer.php'); ?>