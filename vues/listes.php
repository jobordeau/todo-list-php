<html>
<head><title>Liste</title>
    <style type="text/css">
    table
    {
        border-collapse: collapse;
    }
    td,th
    {
        border: 1px solid black;
    }
    #listes
    {
        border: 0px solid black;
    }
    </style>
</head>

<body>

<?php if(isset($_SESSION['listesPrivees'])) 
    echo "<a href='listes.php'>Se déconnecter</a>"
?>
<a href="../controleur/ConSeConnecter.php">Se connecter</a>
<a href="../controleur/ConInscription.php">Créer un compte</a>



<table width="100%">
<tr>
<td id="listes" align="center">
	<h2>Listes Publiques</h2>
    <form method="post">
        <?php 
            foreach($_SESSION['listesPubliques'] as $liste){
                echo "<input name='action' type='submit' value='❌'><table>
                <tr>
                    <th>$liste->nom</th>
                </tr>";
                foreach($liste->taches as $tache){
                    echo "<tr>
                    <td>$tache->nom
                        <input name='action' type='button' value='-'>  
                    </td>
                    <td><input type='checkbox'";if($tache->faite)echo "checked"; 
                    echo"></td></tr>";
                }
                echo "</table>
                        
                    </br>";
            }
        ?>
    </form>
</td>
<?php if(isset($_SESSION['listesPrivees'])) 
require ('listesPrivees.php');
?>
</tr>
</table>
<div align="center">
<table>
    <tr>
        <th><input name='nomListe' type='text' value='Nom de la liste'></th>
    </tr>
    <tr>
        <td><input name='nomTache' type='text' value='Tache'>
            <input name='action' type='button' value='-'>   
        </td>
    </tr>
    <tr>
        <td><input name='action' type='button' value='ajouter une tache'></td>
    </tr>
</table>
<input name='action' type='submit' value='Ajouter la liste'>
</br></br>
<input name='action' type='submit' value='Confirmer les modifications'>
</div>

</body> </html> 