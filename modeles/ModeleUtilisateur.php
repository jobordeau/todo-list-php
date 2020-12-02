<?php
    require('../entites/Utilisateur.php');
    require('../gateway/Connection.php');
    require('../config/config.php');
    require('../gateway/UtilisateurGateway.php');
    

    class ModeleUtilisateur {
        private UtilisateurGateway $gtw;

        function __construct(){
            global $login, $mdp, $dsn;
            $gtw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        }

        public function authentification(string $nom, string $mdp ): Utilisateur{
            $rows = $this->gtw->find( $nom, $mdp );
            if($rows==NULL) return NULL;
            return new Utilisateur($rows['ID'], $rows['nom'], $rows['mdp']);
        }

        public function creerUtilisateur(string $nom, string $mdp): Utilisateur{
            $id = $this->gtw->find($nom, $mdp );
            if($id==NULL) return NULL;
            return new Utilisateur($id, $nom, $mdp);
        }

        public function modifierUtilisateur(string $nom, string $mdp): Utilisateur{
            // A continuer ICI
            $id = $this->gtw->find($nom, $mdp );
            if($id==NULL) return NULL;
            return new Utilisateur($id, $nom, $mdp);
        }
    }
