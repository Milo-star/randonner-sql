<?php
	session_start();
    include "connectdb.php";

	if(!isset($_SESSION['id'])) {
		// L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
		header('Location: login.php');
		exit;
	}

	if(isset($_POST['button'])){
		try{
			// Récupération des données du formulaire
			$name = $_POST['name'];
			$difficulty = $_POST['difficulty'];
			$distance = $_POST['distance'];
			$durer = $_POST['duration'];
			$deniveler = $_POST['height_difference'];
			$available = $_POST['available'];

			// Insertion des données dans la table "hiking"
			$query = "INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (:name, :difficulty, :distance, :duration, :height_difference, :available)";
			$stmt = $pdo->prepare($query);
			$stmt->execute(array(
							':name' => $name, 
							':difficulty' => $difficulty,
							':distance' => $distance,
							':duration' => $durer,
							':height_difference' => $deniveler,
							':available' => $available));
			
			session_start();
			$_SESSION['success_message'] = "La randonnée a été ajoutée avec succès !";

			// Redirection vers la page read.php
			header("Location: read.php");

		// Afficher si y a une erreur
		}catch(Error $e){
			echo $e;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<div>
			<label for="available">Disponible</label>
			<select name="available">
				<option value="1">Oui</option>
				<option value="0">Non</option>
			</select>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>

