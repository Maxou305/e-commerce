<?php

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

function query1($mysqlConnection){
    $tableStatement = $mysqlConnection->prepare('SELECT * FROM products');
    $tableStatement->execute();
    $table = $tableStatement->fetchAll();
    foreach ($table as $products) :
        echo "<p>".$products['name']."</p>";
    endforeach;
}

query1($mysqlConnection);

function query2($mysqlConnection){
    $tableStatement = $mysqlConnection->prepare('SELECT * FROM products WHERE quantity = 0');
    $tableStatement->execute();
    $table = $tableStatement->fetchAll();
    foreach ($table as $products) :
        echo "<p>".$products['name']."</p>";
    endforeach;
}

function query5($mysqlConnection){
    $tableStatement = $mysqlConnection->prepare('SELECT name, order_product.quantity, price FROM products INNER JOIN order_product ON products.id = order_product.product_id WHERE order_id = 1');
    $tableStatement->execute();
    $table = $tableStatement->fetchAll();
    foreach ($table as $products) :
        echo "<p>".$products['name']."</p>";
        echo "<p>".$products['quantity']."</p>";
        echo "<p>".$products['price']."</p>";
    endforeach;
}

function query7($mysqlConnection){
    $tableStatement = $mysqlConnection->prepare('SELECT SUM(order_product.quantity * price) as total FROM `orders` INNER JOIN order_product ON orders.id = order_product.order_id INNER JOIN products ON order_product.product_id = products.id WHERE date = "2023-09-18"');
    $tableStatement->execute();
    $table = $tableStatement->fetchAll();
    foreach ($table as $order) :
        echo "<p>".$order['total']."</p>";
    endforeach;
}

$sql = "INSERT INTO `products` (`id`, `name`, `description`, `price`, `weight`, `image`, `categories_id`, `quantity`, `available`) VALUES (15, 'TEST', 'Ca ride', 15000, 300, '', 1, 21, b'1')";

function newProduct($mysqlConnection, $sql){
    $tableStatement = $mysqlConnection->prepare($sql);
    $tableStatement->execute();
    echo "<p> Produit ajouté !</p>";
}

function delProduct($mysqlConnection, $sup){
    $tableStatement = $mysqlConnection->prepare("DELETE FROM products WHERE id = $sup");
    $tableStatement->execute();
    echo "<p> Produit supprimé !</p>";
}
?>


<form action="test.php" method="POST">
        <label for="update">Nouvelle catégorie :</label>
        <input type="text" name="update">
    </div>
    <input type="submit" name="update">
</form>

<?php 
if ($_POST['update']){
    $tableStatement = $mysqlConnection->prepare("INSERT INTO categories (id, name) VALUES (4, 'cat4')");
    $tableStatement->execute();
    echo "<p> Catégorie ajouté !</p>";
}

?>
