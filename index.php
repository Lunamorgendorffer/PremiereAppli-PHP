<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
</head>
<body>
    <h1>ACCUEIL</h1>
    <nav>
        <ul>
            <li><a href="index.php">ACCUEIL</a></li>
            <li><a href="recap.php">RECAPUTILATIF</a></li>
        </ul>
    </nav>
    
   

    <h2>Ajouter un produit</h2>

    <form action="traitement.php?action=ajouter" method="post"> 
    <!--  La méthode employée ici est POST, pour ne pas "polluer" l'URL avec les données du
    formulaire. -->
        <p>
            <label>
                Nom du produit: 
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit: 
                <input type="number" step="any" name="price" >
            </label>
        </p>
        <p>
            <label>
                Quantité désirée: 
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
        <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>

    
    
</body>
</html>
<!-- action : (qui indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur
soumettra le formulaire)

method : (qui précise par quelle méthode HTTP les données du formulaire seront
transmises au serveur) -->
