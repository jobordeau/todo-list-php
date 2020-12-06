<td id="listes" align="center">





	<h2>Listes Privées</h2>
    <form method="post"  id="listes">
        <?php 
            $i=0;
            foreach($_SESSION['listesPrivees'] as $liste){
                echo "<input name='action' type='submit' value='❌'>
                <input name='indexPrivee' type='text' value='$i' hidden>
                        <input type='checkbox'value='privée'";if($liste->privee)echo "checked"; 
                        echo">Privée ?
                <table>
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