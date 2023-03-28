<?php
include 'db-functions.php';
session_start();

$products = findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajout produit</title>
</head>
<body>
    <ul class="menu">
        <li class= menu-items><a class="menu-links" href="admin.php">Home</a></li>
        <li class= menu-items><a class="menu-links"href='product.php'>AJOUT PRODUIT</a></li>
        <li class= menu-items ><a  class="menu-links" href="recap.php">RECAPUTILATIF</a></li>
    </ul>
    <?php
    if ((isset($_SESSION['products'])) || !empty($_SESSION['products']) ){ //si la une variable product est déclarée ou est différente de null
        $qtt= 0; // on instancie la qantité à 0
        foreach (($_SESSION['products']) as $products => $product) { 
            $qtt += $product['qtt']; // on incremente la quantité de product
        }
    }
    ?>

    <section class="inputs">
        <h2>Ajouter un produit</h2>
        <div class="cards">
            <div class="card">
                <form action="traitement.php?action=ajouter" method="post"> 
        <!--  La méthode employée ici est POST, pour ne pas "polluer" l'URL avec les données du
        formulaire. -->
                    <p>
                        <label class="info">
                            Nom du produit:     
                            <input type="text" name="name">
                        </label>
                    </p>
                    <p>
                        <label for="description" class="info ">
                        Product description :
                        <textarea name="description" id="description" cols="30" rows="5"></textarea>
                        </label>
                    </p>
                    <p>
                        <label class="info">
                            Prix du produit: 
                            <input type="number" step="any" name="price" >
                        </label>
                    </p>
                    <p>
                        <label class="info">
                            Quantité désirée: 
                            <input type="number" name="qtt" value="1">
                        </label>
                    </p>
                    <p class="pflex">
                    <a href='traitement.php?action=ajouterPanier&id=<?=$product['id']?>'><input type="submit" name="submit" value="Ajouter le produit"></a>
                    </p>
                </form>
            </div>
        </div>
    </section>
    
</body>
</html>
<!-- action : (qui indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur
soumettra le formulaire)

method : (qui précise par quelle méthode HTTP les données du formulaire seront
transmises au serveur) -->
