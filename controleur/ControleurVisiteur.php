<?php
class ControleurVisiteur { 
    
    function __construct($action) {
        try{
            switch(strtolower($action)) {
                case NULL:
                case "afficherlistes":
                    $this->afficherListes();
                    break;

                case "afficherinscription":
                    $this->afficherInscription();
                    break;

                case "afficherconnexion":
                    $this->afficherConnexion();
                    break; 

                case "ajouterliste":
                    $this->ajouterListe();
                    break;
                    
                case "supprimerliste":
                    $this->supprimerListe();
                    break;

                case "affichermodificationliste":
                    $this->afficherModification();
                    break;

                case "modifierliste":
                    $this->modifierListe();
                    break;

                case "ajoutertache":
                    $this->ajouterTache();
                    break;
                
                case "modifieretattaches":
                    $this->modifierEtatTaches();
                    break;

                case "supprimertache":
                    $this->supprimerTache();
                    break;

                case "inscription":
                    $this->inscription();
                    break;

                case "connexion":
                    $this->connexion();
                    break;

                default: //mauvaise action
                    throw new Exception(); // Erreure inattendue
                    break;
            }
        }catch (Exception $e) {
            $dataVueErreur[] =	"Erreur inattendue!!!";
        }

    }
    

    ///////////////


    public static function afficherListes() {
        global $rep,$vues;	
        $modele = new ModeleListe();
        $modeleTache = new ModeleTache();
        $listesPubliques=$modele->trouverListePublique();

        foreach($listesPubliques as $liste){
            $liste->taches=$modeleTache->trouverTacheListe($liste);
        }
        $_SESSION['listesPubliques']=$listesPubliques;        

        $mdlUtilisateur= new ModeleUtilisateur();

        if($mdlUtilisateur->estUtilisateur()){
            // Listes privées :
            $listesPrivees=$modele->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
            foreach($listesPrivees as $liste){
                $liste->taches=$modeleTache->trouverTacheListe($liste);
            }
            $_SESSION['listesPrivees']=$listesPrivees;
        }

        unset($_REQUEST["action"]);
        require ($rep.$vues['newlistes']);
    }
    
    function ajouterListe(){
        $modele=new ModeleListe();
        $nvListe=$_POST['nvListe'];
        Validation::NonVide($nvListe, $dataVueErreur);

        if(empty($dataVueErreur)){
            $liste=$modele->creerListePublique($nvListe);
        }

        $this->afficherListes();
    }

    function supprimerListe(){
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        $indexPublique=$_POST['indexPublique'];

        foreach($_SESSION['listesPubliques'][$indexPublique]->taches as $tache){
            $modeleTache->supprimerTache($tache);
        }
        $modele->supprimerListe($_SESSION['listesPubliques'][$indexPublique]);

        $this->afficherListes();
    }

    
    function afficherModification(){
        global $rep,$vues;
        $_SESSION["listeActuelle"]=$_SESSION['listesPubliques'][$_POST['indexPublique']];
        require ($rep.$vues['modifierListe']);
    }

    function modifierListe(){
        global $rep,$vues;
        $modeleListe = new ModeleListe();
        $modeleTache = new ModeleTache();
        $liste = $_SESSION["listeActuelle"];

        $nomListe = $_REQUEST['nomListe'];
        $nbTaches = count($liste->taches);
        
        Validation::NonVide($nomListe, $dataVueErreur);
       if(!empty($dataVueErreur)){
            require ($rep.$vues['modifierListe']);
            return;
       }

        $modeleListe->modifierListe($liste, $nomListe);

       for($i=0;$i<$nbTaches;$i++){
            if(isset($_REQUEST["nvEtat$i"])) $faite = true; 
            else $faite = false;
            $nomTache = $_REQUEST["nvTache$i"];
            Validation::NonVide($nomTache, $dataVueErreur);
            if(!empty($dataVueErreur)){
                continue;
            }
            $tache = $liste->taches[$i];
            $modeleTache->modifierTache($tache, $nomTache);
            $modeleTache->modifierEtat($tache, $faite);
       }
       if(empty($dataVueErreur)){
        unset($_SESSION["listeActuelle"]);
        $this->afficherListes();
        }else{
            require ($rep.$vues['modifierListe']);
        }
       
    }

    function modifierEtatTaches(){
        $modeleTache = new ModeleTache();
        
        // S'il n'y a pas de tâches 
        if(isset($_REQUEST['indexListe'])){
            $liste = $_SESSION['listesPubliques'][$_REQUEST['indexListe']];
        
            $t=0;
            foreach($liste->taches as $tache){
                if(isset($_REQUEST["checkbox$t"])) $faite = true; 
                else $faite = false;
                $modeleTache->modifierEtat($tache, $faite);
                $t++;
            }
        }
        $this->afficherListes();
    }

    function supprimerTache(){
        // Liste + lsite a chopper
        $modeleTache = new ModeleTache();

        $indexPublique=$_POST['indexListe'];
        $indexTache = $_POST['indexTache'];

        $tache = $_SESSION['listesPubliques'][$indexPublique]->taches[$indexTache];
        
        $modeleTache->supprimerTache($tache);
                
        $this->afficherListes();
    }

    function ajouterTache(){
        global $rep,$vues;
        $modele=new ModeleTache();
        $nvTache = $modele->creerTache('Tâche sans nom', false, $_SESSION["listeActuelle"]->ID);
        $nvTaches = $_SESSION["listeActuelle"]->taches;
        array_push($nvTaches, $nvTache);
        $_SESSION["listeActuelle"]->taches = $nvTaches;
        require ($rep.$vues['modifierListe']);
    }
    
    function afficherInscription(){
        global $rep,$vues;
        require ($rep.$vues['newInscription']);
    }

    function afficherConnexion(){
        global $rep,$vues;
        require ($rep.$vues['connexion']);
    }

    function inscription() {
        global $dataVueErreur;
        global $rep,$vues;

        $nom=$_REQUEST['login'];
        $mdp=$_REQUEST['mdp'];
        $verif=$_REQUEST['verif'];

        $mdlUtil=new ModeleUtilisateur();

        Validation::inscription_form($nom,$mdp, $verif, $dataVueErreur);

        if(empty($dataVueErreur)){
            try{
                $utilisateur=$mdlUtil->creerUtilisateur($nom,$mdp);
            } catch(Exception $e){
                $dataVueErreur[] =	"Cet utilisateur existe déjà";
                require ($rep.$vues['newInscription']);
                return;
            }
            $_SESSION['utilisateur']=$utilisateur;
            $this->afficherListes();
        }	
        else{
            require ($rep.$vues['newInscription']);
        }
    }

    function connexion() {
        global $dataVueErreur;
        global $rep,$vues;
        $nom=$_REQUEST['login'];
        $mdp=$_REQUEST['mdp'];
        
        $modele=new ModeleUtilisateur();

        Validation::connexion_form($nom, $mdp, $dataVueErreur);

        
    
       
        
        if(empty($dataVueErreur)){
            $utilisateur=$modele->authentification($nom,$mdp);
            if(!isset($utilisateur)) {
                $dataVueErreur[] =	"Mot de passe ou identifiant incorrect";
                require ($rep.$vues['connexion']);
            }else{
                $_SESSION['utilisateur'] = $utilisateur;
                $this->afficherListes(); 
            }
        }
        else{
            require ($rep.$vues['connexion']);
        } 
    }

}

