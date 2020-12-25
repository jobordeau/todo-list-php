<?php
    require_once(__DIR__.'/../gateway/Connection.php');
    require_once(__DIR__.'/../config/config.php');
    require_once(__DIR__.'/../entites/Utilisateur.php');
    require_once(__DIR__.'/../gateway/UtilisateurGateway.php');
    

    class ModeleUtilisateur {
        private $gtw;

        function __construct(){
            global $login, $mdp, $dsn;
            $this->gtw = new UtilisateurGateway((Connection::getConnection($dsn, $login, $mdp)));
        }

        public function authentification(string $nom, string $mdp){
            $row = $this->gtw->find($nom);
            if($row==NULL) return NULL; // Si utilisateur inexistant

            if (password_verify($mdp, $row['mdp'])) {
                return new Utilisateur($row['ID'], $nom);
            } else {
                return NULL; // Si mot de passe incorrect
            }
        }

        public function creerUtilisateur(string $nom, string $mdp){ // Exception si existe déjà ce nom
            $hash = password_hash($mdp, PASSWORD_DEFAULT);
            $id = $this->gtw->insert($nom, $hash);
            return new Utilisateur($id, $nom);
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


        function estUtilisateur() {
            return isset($_SESSION['utilisateur']);
		}
    }
