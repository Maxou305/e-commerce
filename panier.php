<?php
    include ('fonctions/my-functions.php');

    // // Traitement de formulaire 
    $product_id  = (int) $_POST['id-panier'];
    $produit_panier = getProduct($product_id);
    $quantite = (int)$_POST["quantite"];
    $prix = $_POST['prix-unitaire-panier'];
    $total = calculTotal ($prix, $quantite);
    $nom = $produit_panier['nom'];
    $totalHT = priceExcludingVAT($total);
    $tva = $total - $totalHT;

    include ('templates/header.php');
?>


<div class="azerty">
    <p>Une commande est passée de : <?php echo (int)$_POST["quantite"]?> <?php echo htmlspecialchars((int)$_POST["id-panier"])?></p>
    <?php var_dump($produit_panier); ?>
</div>


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
                <td><?php echo $nom?></td>
                <td><?php echo formatPrice($prix) ?></td>
                <td><?php echo $quantite?></td>
                <td><?php echo formatPrice($total)?></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td>Total HT</td>
                <td><?php echo formatPrice($totalHT)?></td>
            </tr>
          <tr>
              <td> </td>
              <td> </td>
              <td>TVA</td>
              <td><?php echo formatPrice($tva)?></td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td>Total TTC</td>
                <td><?php echo formatPrice($total)?></td>
            </tr>
        </tbody>
  </table>
</div>

  
  
  <?php include('templates/footer.php');?>