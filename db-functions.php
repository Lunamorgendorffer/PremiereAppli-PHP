<?php
function connexion(){
    $user= "root";

    $pass="";

    $options= [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // précise le type d'erreur que PDO renverra en cas de requête invalide
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // mode de récupération des données de la base par défaut
    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // cette commande force la prise en charge de l'UTF-8 lorsqu'on entrera des données en base
    ];

    $pdo = new PDO('mysql:host=localhost;dbname=store', $user, $pass,$options);

    return $pdo;
    
}

function findAll(){
    $dbh = connexion();
    $sth= $dbh->prepare("select * from product"); //Prépare une requête à l'exécution et retourne un objet
    $sth->execute(); // Exécute une requête SQL
    $result = $sth->fetchAll(); //Récupère la ligne suivante d'un jeu de résultats PDO
    return $result;

}

function findOneById($id){
    $dbh = connexion();
    $sth= $dbh->prepare("select id, name,description,price from product Where id =:id");
    $sth->execute(["id" => $id]);
    return $sth->fetch();    
}

function insertProduct($name, $descr, $price) {
    $dbh = connexion();
    $insert= $dbh->prepare("INSERT INTO product (name, description, price) VALUES(:name,:descr,:price)"); //: = clé 
    $insert->execute([
        "name" => $name, // clé name prend la valeur de $name 
        "description" => $descr,
        "price" => $price
    ]);  

    return $dbh->lastInsertId(); //Methode statique qui permett de récupérer le dernier identifiant inséré
}



