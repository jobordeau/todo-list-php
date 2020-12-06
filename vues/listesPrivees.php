<td id="listes" align="center">





	<h2>Listes Privées</h2>
    <form method="post"  id="listes">
        <?php 
            foreach($_SESSION['listesPrivees'] as $liste){
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