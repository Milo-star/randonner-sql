<?php
session_start();

$host = "localhost";
$dbname = "becode";
$username = "my_user";
$password = "my_password";
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération des informations d'identification de l'utilisateur
$username = $_POST['username'];
$password = $_POST['password'];
$query = 'SELECT * FROM user WHERE username = :username';
$stmp = $pdo->prepare($query);

$stmp->bindParam(":username", $username);

// Exécution de la requête
$stmp->execute();

// Stockage des résultats
$user = $stmp->fetch() ? : null;

// Vérification des informations d'identification
if ($user && $password === $user['password']) {

    // Les informations d'identification sont correctes, définir une variable de session pour indiquer que l'utilisateur est connecté
    $_SESSION['id'] = $user['id'];
    header('Location: create.php');
} else {
    // Les informations d'identification sont incorrectes, affichez un message d'erreur et redirigez l'utilisateur vers la page de connexion
    echo "Nom d'utilisateur ou mot de passe incorrect";
    exit;
}
?>