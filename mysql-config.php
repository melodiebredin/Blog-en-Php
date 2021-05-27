<?php
// Infos de connexion à la base de données
$adresse = "localhost:3306";
$utilisateur = "root";
$motdepasse = "root";
$bdd = "blog";

// Connexion à la base de données
$connexion = new mysqli($adresse, $utilisateur, $motdepasse, $bdd);

// Erreur de connexion
if($connexion->connect_error){
    die("Connexion échouée " . $connexion->connect_error);
}