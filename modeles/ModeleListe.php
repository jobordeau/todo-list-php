<?php
    require_once('../gateway/Connection.php');
    require_once('../config/config.php');
    require_once('../entites/Liste.php');
    require_once('../gateway/ListeGateway.php');
    

    class ModeleListe {
        private $gtw;

        function __construct(){
            global $login, $mdp, $dsn;
            $this->gtw = new ListeGateway(Connection::getConnection($dsn, $login, $mdp));

        }

        public function creerListePrivee(string $nom, int $idUti){
            $id = $this->gtw->insertListePrivee($nom, $idUti);
            return new Liste($id, $nom, true);
        }

        public function creerListePublique(string $nom){
            $id = $this->gtw->insertListePublique($nom);
            return new Liste($id, $nom, false);
        }

        public function trouverListePublique(){
            $listes = array();
            foreach ($this->gtw->findAllPublique() as $row)
                array_push($listes, new Liste($row['ID'], $row['nom'], false));
           return $listes;
        }

        public function trouverListeUtilisateur(int $id){
            $listes = array();
            foreach ($this->gtw->findAllFromUtilisateur($id) as $row)
                array_push($listes, new Liste($row['ID'], $row['nom'], true));
           return $listes;
        }
     
        public function modifierListe(Liste $li, string $nvNom){
            if($li->privee){
                $this->gtw->updateListePrive($li->ID, $nvNom);
            }
            else {
                $this->gtw->updateListePublique($li->ID, $nvNom);
            }
            $li->nom = $nvNom;
        }

        public function supprimerListe(Liste $li){
            if($li->privee){
                return $this->gtw->deleteListePrivee($li->ID);
            }
            $this->gtw->deleteListePublique($li->ID);
        }

    }
