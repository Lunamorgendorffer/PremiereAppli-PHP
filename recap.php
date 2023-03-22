<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <h1>RECAPITULATIF</h1>
    <nav>
        <ul>
            <li><a href="http://localhost/appli/index.php">ACCUEIL</a></li>
            <li><a href="http://localhost/appli/recap.php">RECAPUTILATIF</a></li>
        </ul>
    </nav>
    <?php 
    //Pour afficher le nombre de produits présents en session à tout moment,
    if(isset($_SESSION['products'])){
        $nbProducts = count($_SESSION['products']);
    }
    else{
        $nbProducts = 0;
    }
    echo "<p>Nombre de produits en session : ".$nbProducts."</p>";

    if(!isset($_SESSION['products'])|| empty($_SESSION['products'])){ // Vérifier si la variable de session 'products' n'existe pas ou est vide
        // Si c'est le cas, afficher un message informant qu'il n'y a aucun produit en session
        echo "<p>Aucun produit en session ...</p>";
    }
    else{ // sinon afficher sous forme de  tableau les informations demandées 
        echo "<table>",
                   " <thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                "<tbody>";
        $totalGeneral = 0 ; // Initialiser la variable pour le total général
        foreach($_SESSION['products'] as $index => $product){ // Parcourir tous les produits stockés en session et afficher leurs informations dans le tableau
            echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>", // Afficher le prix formaté du produit en cours, avec un espace insécable et le symbole € à la fin
                        "<td>".$product['qtt']."</td>",
                        "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>", // Afficher le prix TOTAL du ou des  produit en cours, avec un espace insécable et le symbole € à la fin
                    "</tr>";
             $totalGeneral += $product['total'] ; // Ajouter le total de chaque produit au total général
        }
        echo "<tr>",
                "<td colspan=4>Total general: </td>",
                "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</td>",
            "<tr>",
        "</tbody>",
            "</table>";
    }
    
    ?>
</body>
</html>
