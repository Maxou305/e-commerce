<?php
    include ('templates/header.php');
    include ('my-functions.php');

?>


<div class="azerty">
    <p>Une commande est passée de : <?php echo htmlspecialchars((int)$_POST["quantite"])?> <?php echo htmlspecialchars((int)$_POST["id"])?></p>
</div>

<?php include('templates/footer.php');?>