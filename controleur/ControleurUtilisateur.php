<?php
class ControleurUtilisateur { 

    function __construct($action) {
        try{
            switch(strtolower($action)) {

                case "ajouterlisteprivee":
                    $this->ajouterListePrivee();
                    break;    
                
                case "supprimerlisteprivee":
                    $this->supprimerListePrivee();
                    break;

                case "affichermodificationlisteprivee":
                    $this->afficherModificationPrivee();
                    break;

                case "modifierlisteprivee":
                    $this->modifierListePrivee();
                    break;

                case "ajoutertacheprivee":
                    $this->ajouterTachePrivee();
                    break;
                
                case "modifieretattachesprivees":
                    $this->modifierEtatTachesPrivees();
                    break;

                case "supprimertacheprivee":
                    $this->supprimerTachePrivee();
                    break;


                case "deconnexion":
                    $this->deconnexion();
                    break;

                default: //mauvaise action
                    throw new Exception(); // Erreure inattendue
                    break;
            }
        } catch (PDOException $e) {
            //erreur BDD
            $dVueEreur[] =	"Erreur inattendue!!! ";

        } catch (Exception $e2) {
            $dVueEreur[] =	"Erreur inattendue!!! ";
        }

    }
    


    ///////////////

                
    function ajouterListePrivee(){
        $modele=new ModeleListe();
        $nvListe=$_POST['nvListe'];
        // VERIF ICI

        $liste=$modele->creerListePrivee($nvListe, $_SESSION['utilisateur']->ID);

        ControleurVisiteur::afficherListes();
    }

    function supprimerListePrivee(){
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        $indexPrivee=$_POST['indexPrivee'];

        foreach($_SESSION['listesPrivees'][$indexPrivee]->taches as $tache){
            $modeleTache->supprimerTache($tache);
        }
        $modele->supprimerListe($_SESSION['listesPrivees'][$indexPrivee]);

        ControleurVisiteur::afficherListes();
    }

    
    function afficherModificationPrivee(){
        $_SESSION["listeActuelle"]=$_SESSION['listesPrivees'][$_POST['indexPrivee']];
        require (__DIR__.'/../vues/modifierListe.php');
    }

    function modifierListePrivee(){
        $modeleListe = new ModeleListe();
        $modeleTache = new ModeleTache();
        $liste = $_SESSION["listeActuelle"];

        $nomListe = $_REQUEST['nomListe'];
        $nbTaches = count($liste->taches);
        
        // Validations /!\

        $modeleListe->modifierListe($liste, $nomListe);

       for($i=0;$i<$nbTaches;$i++){
            if(isset($_REQUEST["nvEtat$i"])) $faite = true; 
            else $faite = false;
            $nomTache = $_REQUEST["nvTache$i"];

            $tache = $liste->taches[$i];
            $modeleTache->modifierTache($tache, $nomTache);
            $modeleTache->modifierEtat($tache, $faite);
       }
       unset($_SESSION["listeActuelle"]);
       ControleurVisiteur::afficherListes();
    }

    function modifierEtatTachesPrivees(){
        $modeleTache = new ModeleTache();
        
        // S'il n'y a pas de tâches 
        if(isset($_REQUEST['indexListe'])){
            $liste = $_SESSION['listesPrivees'][$_REQUEST['indexListe']];
        
            $t=0;
            foreach($liste->taches as $tache){
                if(isset($_REQUEST["checkbox$t"])) $faite = true; 
                else $faite = false;
                $modeleTache->modifierEtat($tache, $faite);
                $t++;
            }
        }
        ControleurVisiteur::afficherListes();
    }

    function supprimerTachePrivee(){
        // Liste + lsite a chopper
        $modeleTache = new ModeleTache();

        $indexPublique=$_POST['indexListe'];
        $indexTache = $_POST['indexTache'];

        $tache = $_SESSION['listesPrivees'][$indexPublique]->taches[$indexTache];
        
        $modeleTache->supprimerTache($tache);
                
        ControleurVisiteur::afficherListes();
    }

    function ajouterTachePrivee(){
        $modele=new ModeleTache();
        $nvTache = $modele->creerTache('Tâche sans nom', true, $_SESSION["listeActuelle"]->ID);
        $nvTaches = $_SESSION["listeActuelle"]->taches;
        array_push($nvTaches, $nvTache);
        $_SESSION["listeActuelle"]->taches = $nvTaches;
        require (__DIR__.'/../vues/modifierListe.php');
    }

    function deconnexion(){
        unset($_SESSION['utilisateur']);
        require (__DIR__.'/../vues/newlistes.php');
    }

}
