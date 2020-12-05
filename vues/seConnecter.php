<html>
<head><title>Se connecter</title>


</head>

<body>
<a href="../controleur/ConInscription.php" url="">Créer un compte</a>
<div align="center">





	<h2>Se connecter</h2>



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
			<tr><td colspan="2" align=center>
			<?php include('erreurConnexion.php') ; ?>
			</td></tr>
		</table>
		<table> 
			<tr>
				<td><input name="valider" type="submit" value="Se connecter"></td>
			</tr> 
		</table>
	</form>
	
</div>



</body> </html> 