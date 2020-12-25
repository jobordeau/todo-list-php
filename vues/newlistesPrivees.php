<!-- COLONNE PRIVEE-->
<div class="col container-fluid" style="background-color: #FFE0D6;margin: 10px;">
    <div class="row">
        <p class="col text-center" style="background-color: #E0C5BC;">Listes privées</p>
    </div>

        <!-- CHARGEMENT LISTES -->
        <?php
            $l=0; 
            foreach($_SESSION['listesPrivees'] as $liste){
                echo "
                <form class='row' method='post'>
                    <input name='indexPrivee' type='text' value='$l' hidden>

                    <table class='table table-hover' >
                        <thead >
                            <tr>
                                <th colspan='2'>$liste->nom</th>
                            </tr>
                        </thead>
                        <tbody>";        
            $t=0;     
            // CHARGEMENT TACHES       
            foreach($liste->taches as $tache){
                if($tache->faite) $state = "checked"; else $state ="unchecked";
                echo "   
                <tr>
                    <input name='indexTache' type='text' value='$t' hidden>
                    <td>
                        <input style='margin-top: 11px;' type='checkbox' name='action' $state>
                        $tache->nom
                    </td>

                    <td width='10'>
                        <input class='btn btn-outline-danger' name='action' type='submit' value='❌'>
                    </td>
                </tr>
                ";
                $t++;
            }
            // FIN TACHES

                echo "
                        </tbody>
                    </table>
                    <button name='action' type='submit' value='supprimerListePrivee' style='margin: 5px;' class='btn btn-outline-danger'>❌ Supprimer liste</button>
                </form>
                ";
                $l++;
            }   
        ?>
        <!--FIN LISTES-->

    </div>



