<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>
<ul>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href='index.php'>AJOUT PRODUIT</a></li>
        <li><a href="recap.php">RECAPUTILATIF</a></li>
    </ul>
    <?php 
    //Pour afficher le nombre de produits présents en session à tout moment,
    if(isset($_SESSION['products'])){
        $nbProducts = count($_SESSION['products']);
    }
    else{
        $nbProducts = 0;
    }
    echo "<p style=text-align:center>Nombre de produits en session : ".$nbProducts."</p>";

    if(!isset($_SESSION['products'])|| empty($_SESSION['products'])){ // Vérifier si la variable de session 'products' n'existe pas ou est vide
        // Si c'est le cas, afficher un message informant qu'il n'y a aucun produit en session
        echo "<p>Aucun produit en session ...</p>";
        
    }
    else{ // sinon afficher sous forme de  tableau les informations demandées 
        echo "<table class='styled-table'>",
                   " <thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                            "<th>Montant Total</th>",
                            "<th>Option</th>",
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
                        "<td>
                            <a href='traitement.php?action=moins&id=".$index."'><button>-</button></a>
                            ".number_format($product['qtt'])."
                            <a href='traitement.php?action=plus&id=".$index."'><button>+</button></a>
                            </td>",
                        "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>", // Afficher le prix TOTAL du ou des  produit en cours, avec un espace insécable et le symbole € à la fin
                        // ajout d'un bouton supprimer ligne
                        "<td id='button'><a href='traitement.php?action=supprimer&id=".$index."' ><button class='supp'>Supprimer</button><a></td>",
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
    
    
    
    // Afficher le message de succès ou d'erreur s'il existe
    if (isset($_SESSION['message'])) {
        echo "<p>".$_SESSION['message']."</p>";
        // Supprimer la variable de session pour qu'elle ne soit affichée qu'une seule fois
        unset($_SESSION['message']);
    }
    ?>

    <div class="panier">
    <a class="panier" href="traitement.php?action=vider&id="><button>Vider Panier</button></a>

    </div>

</body>
</html>
