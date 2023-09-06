<?php
    include('templates/header.php');
    ?>

<div class="article-panier">
    <img src="images/draisienne.jpg" alt="draisienne">
    <div>
        <h3>Mon produit</h3>
        <p>Prix barré + ristourne</p>
        <p>Prix TTC : prix après ristourne</p>
        <label for="quantite">Quantité :</label>
        <select name="nombre" id="quantite">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <a class="cta" href="">Commander</a>
    </div>
</div>



<?php
    include('templates/footer.php');
?>