<?php

$host = "localhost"; 
$dbname = "tour_operateur"; 
$username = "root"; 
$password = ""; 

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Etat Du Serveur: vous ete connecté";
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}



?>