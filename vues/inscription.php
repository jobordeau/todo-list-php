<html>
<head><title>Inscription</title>


</head>

<body>
<a href="../controleur/ConSeConnecter.php" url="">Se connecter</a>
<div align="center">





	<h2>Inscription</h2>



	<form method="post" name="myform" id="myform">
		<table> 
			<tr>
				<td>Identifiant</td>
				<td><input name="txtNom"  type="text" size="20"></td>
			</tr>
			<tr>
				<td>Mot de passe</td>
				<td><input name="txtMdp"  type="text" size="20"></td>
			</tr>
			<tr>
				<td></td>
				<td><input name="txtConf"  type="text" size="20" placeholder="Confirmer le mot de passe"></td>
			</tr> 
			<tr><td colspan="2" align=center>
			<?php include('erreurConnexion.php') ; ?>
			</td></tr>
		</table>
		<table> 
			<tr>
				<td><input name="valider" type="submit" value="Créer un compte"></td>
			</tr> 
		</table>
	</form>
	
</div>



</body> </html> 