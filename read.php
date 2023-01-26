<?php
    include "connectdb.php";

    while ($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td> ";
        echo "<td>" . $row['name'] . "</td> ";
        echo "<td>" . $row['difficulty'] . "</td> ";
        echo "<td>" . $row['distance'] . "</td> ";
        echo "<td>" . $row['duration'] . "</td> ";
        echo "<td>" . $row['height_difference'] . "</td> <a href='/update.php?id=".$row["id"]."'>Modifier</a><br>";
        echo "</tr>";
    }

    session_start();
    if(isset($_SESSION['success_message'])) {
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
    }
?>
