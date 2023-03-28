<?php
//une session permet de stocker des données utilisateur sur le serveur de manière à pouvoir les réutiliser sur différentes pages web.
session_start(); // démarrer une session sur le serveur pour l'utilisateur courant ou reprendre une session existante

include 'db-functions.php';

if (isset($_GET['action'])){ // isset : Détermine si une variable est déclarée ET est différente de null
     
    switch($_GET['action']){ // équivaut à une série d'instruction if
        case "ajouter": 
            if (isset($_POST['submit'])){ //si le formulaire a été soumis et si le bouton "submit" a été cliqué. Alors,

                $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  //supprime une chaîne de caractères de toute présence de caractères spéciaux et de toute balise HTML 
                $price = filter_input(INPUT_POST,"price", FILTER_VALIDATE_FLOAT); //On valide le prix que s'il est un nombre à virgule (pas de texte ou autre…), le drapeau FILTER_FLAG_ALLOW_FRACTION est ajouté pour permettre l'utilisation du caractère "," ou "." pour la décimale.
                $descr = filter_input(INPUT_POST,"descr", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //e validera la quantité que si celle-ci est un nombre entier, au moins égal à 1.
            
                if($name && $price && $descr){
            
                    $product = [
                        "name" => $name, // prend la valeur de la variable name 
                        "price"=> $price, // prend la valeur de la variable price
                        "descr" => $descr
                        // "qtt" => $qtt, // prend la valeur de la variable qtt
                        // "total"=> $price*$qtt, // prend la valeur du produit price x qtt
                    ];
                    $id = insertProduct($product['name'], $product['descr'], $product['price']); // initialisation de la fonction
                    header("Location:product.php?id=".$id);
            
                    // $_SESSION['products'][]=$product; // Ajouter le produit actuel à la session des produits
                    
                    $_SESSION['message'] = "Produit ajouté avec succès !";
                    
                }else {
                    // Stocker le message d'erreur dans une variable de session
                    $_SESSION['message'] = "Erreur : veuillez vérifier les informations saisies.";
                }
            }  
         // Instruction permettant de sortir de la structure 
        break;

        case "ajouterPanier": // fonction pour ajouter un produit
            if (isset($_GET['id'])) {

                $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); //
                $item = findOneById($id);
                $qtt = 1;

                if ($id) {

                    $product = [
                        "name" => $item['name'],
                        "price" => $item['price'],
                        "qtt" => $qtt,
                        "total" => $item['price'] * $qtt
                    ];
                    
                    $_SESSION['products'][] = $product;
                    $_SESSION['message'] = "Produit ajouté avec succès !";
                    header("Location:recap.php");
                }
            }
        break; // fin de cette condition du switch
    
        // Vider le panier en totalité
        case "vider" :
            // vide les tableaux dans session
            unset($_SESSION['products']);
            // redirige à la page 
            header("Location:recap.php");
            // die : équivaut à exit
            $_SESSION['message'] = "Vous avez vidé le panier!";
            die();           
        break;
        // Supprimer un produit de la liste
        case "supprimer" :
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                // "id" est lié à l'index de du produit dans "index.php"
                unset($_SESSION['products'][$_GET['id']]);
                $_SESSION['message'] = "Vous avez supprimé un article !";
            } 
            header("Location:recap.php");
            die();

        break;

        // Bouton + sur les produits
        case "plus" :
            if ($_SESSION['products'][$_GET['id']]['qtt'] >= 1) {
                ++$_SESSION['products'][$_GET['id']]['qtt'];  // on incrémente la valeur de "qtt" de l'index correspondant.
    
                // le calcul du total est relancé
                $_SESSION['products'][$_GET['id']]['total'] =
                $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'];
            }
            header("Location:recap.php");
            die();
        break;

        // Bouton - sur les produits
        case "moins" :
            if ($_SESSION['products'][$_GET['id']]['qtt'] > 0) {
                --$_SESSION['products'][$_GET['id']]['qtt'];  //On décrémente la "qtt" de l'index correspondant.
    
                $_SESSION['products'][$_GET['id']]['total'] =
                $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'];
            } else  {
                unset($_SESSION['products'][$index]);    
                $_SESSION['message'] = "Vous avez supprimé un article !";
                
            }
            header("Location:recap.php");
            die();               
        break;

    
        
    }

    
}


// //fonction pour creer un message du succès ou de l'erreur 
// if ($name && $price && $qtt) {
//     // Ajouter le produit à la session des produits
//     $_SESSION['products'][] = $product;
//     // Stocker le message de succès dans une variable de session
//     $_SESSION['message'] = "Produit ajouté avec succès !";
// } else {
//     // Stocker le message d'erreur dans une variable de session
//     $_SESSION['message'] = "Erreur : veuillez vérifier les informations saisies.";
// }


header("location:index.php"); // Rediriger l'utilisateur vers la page d'accueil (index.php)
?>