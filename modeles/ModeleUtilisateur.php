<?php
    require_once('../gateway/Connection.php');
    require_once('../config/config.php');
    require_once('../entites/Utilisateur.php');
    require_once('../gateway/UtilisateurGateway.php');
    

    class ModeleUtilisateur {
        private $gtw;

        function __construct(){
            global $login, $mdp, $dsn;
            $this->gtw = new UtilisateurGateway((Connection::getConnection($dsn, $login, $mdp)));
        }

        public function authentification(string $nom, string $mdp){
            $id = $this->gtw->find( $nom, $mdp );
            if($id==NULL) return NULL; // Si non trouvé
            return new Utilisateur($id, $nom, $mdp);
        }

        public function creerUtilisateur(string $nom, string $mdp){ // Exception si existe déjà ce nom
            $id = $this->gtw->insert($nom, $mdp);
            return new Utilisateur($id, $nom, $mdp);
        }

        public function modifierUtilisateur(Utilisateur $uti, string $nvNom, string $nvMdp): bool{ // Exception si existe déjà ce nom
            if($this->gtw->findByID($uti->ID)==NULL) return false; // Utilisateur n'existe pas
            $this->gtw->update($uti->ID, $nvNom, $nvMdp);
            $uti->nom = $nvNom;
            $uti->mdp = $nvMdp;
            return true;
        }

        public function supprimerUtilisateur(int $id): bool{
            if($this->gtw->findByID($id)==NULL) return false; // Utilisateur n'existe pas
            return $this->gtw->delete($id);
        }

    }
