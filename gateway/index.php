<html>

<body>


<?php

	require("Connection.php");

	//A CHANGER (utiliser pour tester localement)
	$user= 'alann';
	$pass='user';
	$dsn='mysql:host=localhost;dbname=projet_php';

	try{
		$con=new Connection($dsn,$user,$pass);

		$query = "SELECT ID FROM utilisateur WHERE nom=:nom";
		$retour = $con->executeQuery($query, array(':nom' => array("Jojo", PDO::PARAM_STR)));
		echo $con->getResults()[0]['ID']+10;
	}
	catch( PDOException $Exception ) {
		echo 'erreur :';
		echo $Exception->getMessage();
	}
?>

</body>
</html>
