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
    </style>
</script>
</head>

<body>


<a href="../controleur/ConSeConnecter.php" url="">Se connecter</a>
<a href="../controleur/ConInscription.php" url="">Créer un compte</a>



<div align="center">





	<h2>Listes</h2>
    <form method="post" name="myform" id="myform">
        <?php 
            foreach($_SESSION['listeVisible'] as $liste){
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
    </form>


	
</div>


</body> </html> 