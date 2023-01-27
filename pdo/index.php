<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Connexion à la base de données
    $host = "localhost";
    $dbname = "colyseum";
    $username = "my_user";
    $password = "my_password";
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $queryClient = "SELECT * FROM clients LIMIT 20";
    $resultClients = $pdo->query($queryClient);

    $queryTypes = "SELECT * FROM showTypes";
    $resultTypes = $pdo->query($queryTypes);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table>
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            while ($rowClients = $resultClients->fetch()) {
                echo "<tr>";
                echo "<td>" . $rowClients['id'] . "</td> ";
                echo "<td>" . $rowClients['firstName'] . "</td> ";
                echo "</tr>";
            }

            while ($rowTypes = $resultTypes->fetch()) {
                echo "<tr>";
                echo "<td> Types de concert: <strong>" . $rowTypes['type'] . "</td> ";
                echo "</tr>";
            }
        ?> 
    </tbody>
    </table>
    </body>
</html>