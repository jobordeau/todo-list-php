<html>

<body>


<?php

	require("Connection.php");
	require("UtilisateurGateway.php");

	//A CHANGER (utiliser pour tester localement)
	$user= 'alann';
	$pass='user';
	$dsn='mysql:host=localhost;dbname=projet_php';

	try{
		$conn=new Connection($dsn,$user,$pass);

		// TESTS (locaux)
		
		/*
		// Création de la requête
		$id=2;
		$query = "SELECT * FROM list WHERE ID=:id";
		// Exécution de la requête
		$con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
		// Affichage du résultat de la requête
		foreach ($con->getResults() as $row)
			echo $row['nom']." ".$row['createur']."</br>";
		
		// Création de la requête
		$id=4;
		$nom="Vaisselle";
		$createur="Sacha";
		$query = "INSERT INTO list VALUES(:id,:nom,:createur)";
		// Exécution de la requête
		$con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT),
										':nom' => array($nom, PDO::PARAM_STR),
										':createur' => array($createur, PDO::PARAM_STR)));
		// Affichage du résultat de la requête
		foreach ($con->getResults() as $row)
			echo $row['nom']." ".$row['createur']."</br>";
		

		// AFFICHAGE DE TOUTE LA TABLE
		$query = "SELECT * FROM list"; // Création de la requête
		$con->executeQuery($query); // Exécution de la requête
		foreach ($con->getResults() as $row) // Affichage du résultat de la requête
			echo $row['ID']." ".$row['nom']." ".$row['createur']."</br>";

		// AFFICHAGE DE LA LIGNE ID=2
		$query = "SELECT * FROM list WHERE ID=:id"; // Création de la requête
		$con->executeQuery($query, array(':id' => array(2, PDO::PARAM_INT))); // Exécution de la requête
		foreach ($con->getResults() as $row) // Affichage du résultat de la requête
			echo $row['ID']." ".$row['nom']." ".$row['createur']."</br>";
		// MODIFICATION DE LA LIGNE ID=2
		$query = "UPDATE list SET NOM=:nom WHERE ID=:id";
		$con->executeQuery($query, array(':id' => array(2, PDO::PARAM_INT),
							':nom' => array("bazard", PDO::PARAM_STR))); 
		// AFFICHAGE DE LA LIGNE ID=2
		$query = "SELECT * FROM list WHERE ID=:id"; // Création de la requête
		$con->executeQuery($query, array(':id' => array(2, PDO::PARAM_INT))); // Exécution de la requête
		foreach ($con->getResults() as $row) // Affichage du résultat de la requête
			echo $row['ID']." ".$row['nom']." ".$row['createur']."</br>";
			*/
	}
	catch( PDOException $Exception ) {
		echo 'erreur :';
		echo $Exception->getMessage();
	}
?>

</body>
</html>
