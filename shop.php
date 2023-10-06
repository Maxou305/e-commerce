<?php
include('fonctions/my-functions.php');
include('templates/header.php');
include_once('Catalogue.php');

try{
    $mysqlConnection = new PDO(
    'mysql:host=localhost;
    dbname=test;
    charset=utf8',
    'lpzkjdoi',
    'mofwi6-jiGjoc-sutjob'
    );
}
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

?>

<div class="shop">
    <?php 
    $catalogue = new Catalogue($mysqlConnection);


    displayCatalogue($catalogue);
   ?>
</div>
<?php include('templates/footer.php'); ?>

