<?php
include('fonctions/my-functions.php');
include('templates/header.php');

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

?>

<div class="shop">
    <?php 
    foreach (getProducts($mysqlConnection) as $produit) : ?>
        <div class="produit">
            <img src="<?php echo $produit['image'] ?>" alt="">
            <div>
                <h2><?php echo $produit['name'] ?></h2>
                <p><?php echo $produit['description'] ?></p>
                <p class="poids">Poids : <?php echo $produit['weight'] ?> g</p>
                <p class="prix-ttc">Prix TTC : <?php formatPrice($produit['price']) ?></p>
                <p class="ristourne">RISTOURNE : <?php echo $produit['discount'] ?><?php if ($produit['discount'] == null) echo "0" ?> %</p>
                <p class="prix-ristourne-ttc">Prix TTC après ristourne : <?php formatPrice(discountedPrice($produit['price'], $produit['discount'])) ?></p>
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
                    <input type="hidden" name="id-panier" value="<?php echo $produit['id'] ?>">
                    <button class="cta">Commander</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include('templates/footer.php'); ?>