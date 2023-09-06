<?php
    include('templates/header.php');
    $products = [
        "velo" => [
            "nom" => "Vélo",
            "prix" => 1500,
            "poids" => 5.5,
            "ristourne" => 10,
            "photo" => "images/velo.jpg",
        ],
        "trottinette" => [
            "nom" => "Trottinette",
            "prix" => 300,
            "poids" => 2.5,
            "ristourne" => null,
            "photo" => "images/trottinette.jpg"
        ],
        "scooter" => [
            "nom" => "Scooter",
            "prix" => 3000,
            "poids" => 50,
            "ristourne" => 10,
            "photo" => "images/scooter.jpg"
        ],
        "draisienne" => [
            "nom" => "Draisienne",
            "prix" => 35,
            "poids" => 1,
            "ristourne" => null,
            "photo" => "images/draisienne.jpg"
        ],
        "moto" => [
            "nom" => "Moto",
            "prix" => 15000,
            "poids" => 150,
            "ristourne" => 5,
            "photo" => "images/moto.jpg",
        ],
    ];
?>
<?php foreach ($products as $produit) : ?>
    <div class="produit">
        <h2 class="titre-produit"><?php echo $produit['nom'] ?></h2>
        <p>description produit</p>
        <img src="<?php echo $produit['photo'] ?>" alt="">
        <p class="poids">Poids : <?php echo $produit['poids'] ?> kg</p>
        <p class="prix-ttc">Prix TTC : <?php formatPrice($produit['prix']) ?></p>
        <p class="prix-ht">Prix HT : <?php formatPrice(priceExcludingVAT($produit['prix'])) ?></p>
        <p class="ristourne">RISTOURNE : <?php echo $produit['ristourne'] ?><?php if ($produit['ristourne'] == null) echo "0" ?> %</p>
        <p class="prix-ristourne-ttc">Prix TTC après ristourne : <?php formatPrice(discountedPrice($produit['prix'], $produit['ristourne'])) ?></p>
        <p class="prix-ristourne-ht">Prix HT après ristourne: <?php formatPrice(priceExcludingVAT(discountedPrice($produit['prix'], $produit['ristourne']))) ?></p>
    </div>
<?php endforeach;

include('templates/footer.php');