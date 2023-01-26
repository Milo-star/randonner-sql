<?php
    include "connectdb.php";

    while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td> ";
        echo "<td>" . $row['name'] . "</td> ";
        echo "<td>" . $row['difficulty'] . "</td> ";
        echo "<td>" . $row['distance'] . "</td> ";
        echo "<td>" . $row['duration'] . "</td> ";
        echo "<td>" . $row['height_difference'] . "</td> <a href='update.php?id=".$row["id"]."'>Modifier</a> <a href='#'>Supprimer</a><br>";
        echo "</tr>";
    }

      if(isset($_POST['submit_remove'])){
      if(!empty($_POST['ville'])){
          foreach($_POST['ville'] as $ville){
              $query = "DELETE FROM meteo WHERE ville = :ville";
              $stmt = $pdo->prepare($query);
              $stmt->execute(array(':ville' => $ville));
          }
          echo "Ville(s) supprimée(s) avec succès";
      }
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
