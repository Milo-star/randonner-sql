<?php
include "connectdb.php";
session_start();
if (!isset($_SESSION['id'])) {
	// L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
	header('Location: login.php');
	exit;
}

if (isset($_POST['button'])) {
	if (!empty($_POST['name']) && !empty($_POST['difficulty']) && !empty($_POST['distance']) && !empty($_POST['duration']) && !empty($_POST['height_difference']) && isset($_POST['available']) && !empty($_GET['id'])) {
		$query = "UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference, available = :available WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array(':name' => $_POST['name'], ':difficulty' => $_POST['difficulty'], ':distance' => $_POST['distance'], ':duration' => $_POST['duration'], ':height_difference' => $_POST['height_difference'], ':available' => $_POST['available'], ':id' => $_GET['id']));
		$_SESSION['success_message'] = "Randonnée modifiée avec succès";
		header("Location: read.php");
	}
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM hiking WHERE id = :id";
	$stmt = $pdo->prepare($query);
	$stmt->execute(array(':id' => $id));
	$row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modifier une randonnée</title>
</head>

<body>
	<a href="read.php">Liste des données</a>
	<h1>Modifier</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $row['name'] ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile" <?php echo ($row['difficulty'] == "très facile") ? "selected" : "" ?>>Très
					facile</option>
				<option value="facile" <?php echo ($row['difficulty'] == "facile") ? "selected" : "" ?>>Facile</option>
				<option value="moyen" <?php echo ($row['difficulty'] == "moyen") ? "selected" : "" ?>>Moyen</option>
				<option value="difficile" <?php echo ($row['difficulty'] == "difficile") ? "selected" : "" ?>>Difficile
				</option>
				<option value="très difficile" <?php echo ($row['difficulty'] == "très difficile") ? "selected" : "" ?>>
					Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?= $row['distance'] ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="<?= $row['duration'] ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?= $row['height_difference'] ?>">
		</div>
		<div>
			<label for="available">Disponible</label>
			<select name="available">
				<option value="1" <?php echo $row['available'] == 1 ? 'selected' : '' ?>>Oui</option>
				<option value="0" <?php echo $row['available'] == 0 ? 'selected' : '' ?>>Non</option>
			</select>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
	<a href="logout.php">Se déconnecter</a>
</body>

</html>