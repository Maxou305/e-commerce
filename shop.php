<?php
    include('templates/header.php');
    $products = [
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
?>
<div class="shop">
    <?php foreach ($products as $produit) : ?>
        <div class="produit">
            <img src="<?php echo $produit['photo']?>" alt="">
            <div>
                <h2><?php echo $produit['nom']?></h2>
                <p>description produit</p>
                <p class="poids">Poids : <?php echo $produit['poids'] ?> kg</p>
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
                    <input type="hidden" name="id" value="<?php echo $produit['id']?>">
                    <button class="cta">Commander</button>
                </form>
            </div>
        </div>
    <?php endforeach;?>
</div>
<?php include('templates/footer.php');?>