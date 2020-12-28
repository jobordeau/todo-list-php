<!-- COLONNE PRIVEE-->
<div class="col container-fluid" style="background-color: #FFE0D6;margin: 10px;">
    <div class="row">
        <p class="col text-center" style="background-color: #E0C5BC;">Listes privées</p>
    </div>

    <!-- CHARGEMENT LISTES -->
    <?php
    $l = 0;
    foreach ($_SESSION['listesPrivees'] as $liste) {
        echo "
                <form method='post' id='formListePrivee$l'>
                    <input name='indexPrivee' type='text' value='$l' hidden>

                    <table class='table table-hover' >
                        <thead >
                            <tr>
                                <th colspan='2'>$liste->nom</th>
                            </tr>
                        </thead>
                </form>
                        <tbody>";
        echo "<form method='post' id='formTachesListePrivee$l'>";
        $t = 0;
        // CHARGEMENT TACHES       
        foreach ($liste->taches as $tache) {
            if ($tache->faite) $state = "checked";
            else $state = "unchecked";
            echo "
                    <form method='post'>   
                        <tr>
                            <input name='indexListe' type='number' value='$l' hidden>
                            <input name='indexTache' type='number' value='$t' hidden>
                            <td>
                                <input type='checkbox' name='checkbox$t' form='formTachesListePrivee$l' style='margin-top: 11px;' $state>
                                <label> $tache->nom <label>
                            </td>

                            <td width='10'>
                                <button name='action' type='submit' value='supprimerTachePrivee' class='btn btn-outline-danger'>❌</button>
                            </td>
                        </tr>
                    </form>
                    
                    ";
            $t++;
        }
        // FIN TACHES

        echo "  </form>
                        </tbody>
                    </table>
                    <button name='action' type='submit' value='modifierEtatTachesPrivees' form='formTachesListePrivee$l' style='margin: 5px;' class='btn btn-outline-success'>✓ Enregistrer l'état des tâches</button> 
                    
                    <button name='action' type='submit' value='afficherModificationListePrivee' form='formListePrivee$l' style='margin: 5px;' class='btn btn-outline-info' >🖊️ Modifier la liste</button>
                    <button name='action' type='submit' value='supprimerListePrivee' form='formListePrivee$l' style='margin: 5px;' class='btn btn-outline-danger'>❌ Supprimer la liste</button>
                ";
        $l++;
    }
    ?>
    <!--FIN LISTES-->

</div>