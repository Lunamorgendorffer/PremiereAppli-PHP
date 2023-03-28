<?php
include 'db-functions.php';

$id= $_GET['id']; //on récupère les id depuis la session

$product=findOneById($id); // déclaration variable pour utilisé la fonction dans db-function

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Product</title>
</head>
<body>
    <ul class="menu">
        <li class= menu-items><a class="menu-links" href="admin.php">Home</a></li>
        <li class= menu-items><a class="menu-links"href='index.php'>AJOUT PRODUIT</a></li>
        <li class= menu-items ><a  class="menu-links" href="recap.php">RECAPUTILATIF</a></li>
    </ul>

    <a href='index.php'>Retour</a><br>
    <div class="card">
        <div class="card">
            <?php   

                echo "<p>".$product['name']."</p><br>
                <p>".$product['description']."</p><br><p>"
                .number_format($product['price'],2,",","&nbsp;")."€</p><br>";
            ?>
        </di>
    </di>
    <br><a href='traitement.php?action=ajouterPanier&id=<?=$product['id']?>'>Ajouter au panier</a>
    
    

</body>
</html>