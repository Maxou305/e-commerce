<?php
    include ('fonctions/my-functions.php');
    include('templates/header.php');

?>

<div class="shop">
    <?php foreach (getProducts() as $produit) : ?>
        <div class="produit">
            <img src="<?php echo $produit['photo']?>" alt="">
            <div>
                <h2><?php echo $produit['nom']?></h2>
                <p>description produit</p>
                <p class="poids">Poids : <?php echo $produit['poids'] ?> g</p>
                <p class="prix-ttc">Prix TTC : <?php formatPrice($produit['prix']) ?></p>
                <p class="ristourne">RISTOURNE : <?php echo $produit['ristourne'] ?><?php if ($produit['ristourne'] == null) echo "0" ?> %</p>
                <p class="prix-ristourne-ttc">Prix TTC après ristourne : <?php formatPrice(discountedPrice($produit['prix'], $produit['ristourne'])) ?></p>
                <form action="panier.php" method="POST">
                    <div class="select">
                        <label for="quantite">Quantité :</label>
                        <select name="quantite" id="quantite">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <input type="hidden" name="id-panier" value="<?php echo $produit['id']?>">
                    <button class="cta">Commander</button>
                </form>
            </div>
        </div>
    <?php endforeach;?>
</div>
<?php include('templates/footer.php');?>