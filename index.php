<?php
include 'db-functions.php';

$products=findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Panier</title>
</head>
<body>
    <ul class="menu">
        <li class= menu-items><a class="menu-links" href="admin.php">Home</a></li>
        <li class= menu-items><a class="menu-links"href='index.php'>AJOUT PRODUIT</a></li>
        <li class= menu-items ><a  class="menu-links" href="recap.php">RECAPUTILATIF</a></li>
    </ul>


    <table class='styled-table'>
        <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Decription</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php   
            foreach($products as $product){
                echo "<tr>",
                "<td>".$product['id']."</td>",
                "<td><a href='product.php?id=".$product['id']."'>".$product['name']."</a></td>",
                "<td>" .substr($product['description'], 0, 50). "...</td>",
                "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>", 
                "</tr>";
            }
            ?>
            <tr>
            <td><a href='traitement.php?action=ajouterPanier&id=<?=$product['id']?>'>Ajouter au panier</a></td>
            <tr>
        </tbody>
        </table>

    
</body>
</html>
