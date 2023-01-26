<?php
    include "connectdb.php";
    session_start();

    if(isset($_POST['submit_remove'])){
        if(!empty($_POST['id'])){
            $query = "DELETE FROM hiking WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':id' => $_POST['id']));
            $_SESSION['success_message'] = "Randonnée supprimée avec succès";
			header("Location: read.php");
        }
    }

    while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td> ";
        echo "<td>" . $row['name'] . "</td> ";
        echo "<td>" . $row['difficulty'] . "</td> ";
        echo "<td>" . $row['distance'] . "</td> ";
        echo "<td>" . $row['duration'] . "</td> ";
        echo "<td>" . $row['height_difference'] . "</td> <a href='update.php?id=".$row["id"]."'>Modifier</a> <form method='post'><input type='hidden' name='id' value='".$row["id"]."'><input type='submit' name='submit_remove' value='Supprimer'></form><br>";        
        echo "</tr>";
    }

    session_start();
    if(isset($_SESSION['success_message'])) {
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des données</title>
</head>
<body>
    
</body>
</html>
