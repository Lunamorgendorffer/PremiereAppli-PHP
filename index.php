<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ajout produit</title>
</head>
<body>
    <ul>
        <li><a  href="#home">Home</a></li>
        <li><a href='index.php'>AJOUT PRODUIT</a></li>
        <li><a href="recap.php">RECAPUTILATIF</a></li>
    </ul>
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
                <p>
                <input type="submit" name="submit" value="Ajouter le produit">
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
