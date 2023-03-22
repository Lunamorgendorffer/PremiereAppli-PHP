<?php
//une session permet de stocker des données utilisateur sur le serveur de manière à pouvoir les réutiliser sur différentes pages web.
session_start(); // démarrer une session sur le serveur pour l'utilisateur courant ou reprendre une session existante

if (isset($_POST['submit'])){ //si le formulaire a été soumis et si le bouton "submit" a été cliqué. Alors,

    $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  //supprime une chaîne de caractères de toute présence de caractères spéciaux et de toute balise HTML 
    $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //On valide le prix que s'il est un nombre à virgule (pas de texte ou autre…), le drapeau FILTER_FLAG_ALLOW_FRACTION est ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
    $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT); //e validera la quantité que si celle-ci est un nombre entier, au moins égal à 1.

    if($name && $price && $qtt){

        $product = [
            "name" => $name, // prend la valeur de la variable name 
            "price"=> $price, // prend la valeur de la variable price
            "qtt" => $qtt, // prend la valeur de la variable qtt
            "total"=> $price*$qtt, // prend la valeur du produit price x qtt
        ];

        $_SESSION['products'][]=$product; // Ajouter le produit actuel à la session des produits
    }
}


header("location:index.php"); // Rediriger l'utilisateur vers la page d'accueil (index.php)
?>