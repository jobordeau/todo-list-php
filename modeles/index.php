<html>

<body>


<?php
require("ModeleTache.php");
/*
$base="projet_php";
$login="alann";
$mdp="user";
$dsn = "mysql:host=localhost;dbname=$base";
$con = new Connection($dsn, $login, $mdp);
*/

	try{
		$m = new ModeleTache();

		$m->supprimerTache(new Tache(1, "e", false));
	} 


	catch( PDOException $Exception ) {
		echo 'erreur :';
		echo $Exception->getMessage();
	}
?>

</body>
</html>
