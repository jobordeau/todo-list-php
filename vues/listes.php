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
<?php 
    if(isset($_SESSION['utilisateur'])) 
        echo "<form method='post'><input name='action' type='submit' value='Se déconnecter'></form>";
    else
        echo "<a href='../controleur/ConSeConnecter.php'>Se connecter</a>
              <a href='../controleur/ConInscription.php'>Créer un compte</a>";
?>




<table width="100%">
<tr>
<td id="listes" align="center">
	<h2>Listes Publiques</h2>
    <form method="post">
        <?php
            $i=0; 
            foreach($_SESSION['listesPubliques'] as $liste){
                echo "<input name='action' type='submit' value='❌'><table>
                        <input name='indexPublique' type='text' value='$i' hidden>
                        <input type='checkbox'value='privée'";if($liste->privee)echo "checked"; 
                        echo">Privée ?
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
                $i=$i+1;
            }
        ?>
    </form>
</td>
<?php if(isset($_SESSION['utilisateur'])) 
require ('listesPrivees.php');
?>
</tr>
</table>
<div align="center">
<form method="post">
<table>
    <tr>
        <th><input name='nomListe' type='text' value='Nom de la liste'></th>
        <?php if(isset($_SESSION['utilisateur'])) 
            echo "<input name='etatListe' type='checkbox' value='privee'>Privée ?"
        ?>
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
</form>
</div>

</body> </html> 