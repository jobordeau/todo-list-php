<html>
<head><title>Se connecter</title>


</head>

<body>
<a href="../vues/inscription.php" url="">Créer un compte</a>
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
				<?php
					if (isset($dataVueErreur) && count($dataVueErreur)>0) {
					foreach ($dataVueErreur as $value){
						if(next($dataVueErreur) != null)
							echo "$value / ";
						else
							echo "$value !";
					}}
				?>
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