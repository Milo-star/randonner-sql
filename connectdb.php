<?php
    // Connexion à la base de données
    $host = "localhost";
    $dbname = "becode";
    $username = "my_user";
    $password = "my_password";
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

     $query = "SELECT * FROM hiking";
     $result = $pdo->query($query);