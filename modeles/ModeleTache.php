<?php

    class ModeleTache {
        private $gtw;

        function __construct(){
            global $login, $mdp, $dsn;
            $this->gtw = new TacheGateway((Connection::getConnection($dsn, $login, $mdp)));
        }

        public function creerTache(string $nom, bool $privee , int $idLi){
            $id = $this->gtw->insertTache($nom, $idLi);
            return new Tache($id, $nom, $privee);
        }  

        public function trouverTacheListe(Liste $li){
            $taches = array();
            $rows = $this->gtw->findAllFromListe($li->ID);
            foreach ($rows as $row)
                array_push($taches, new Tache($row['ID'], $row['nom'], $li->privee ,$row['faite']));
           return $taches;
        }
     
        public function modifierTache(Tache &$ta, string $nvNom){
            $this->gtw->updateTache($ta->ID, $nvNom);
            $ta->nom = $nvNom;
        }
        
        public function modifierEtat(Tache &$ta, bool $faite){
            $this->gtw->updateTacheFaite($ta->ID, $faite);
            $ta->nom = $faite;
        }

        public function supprimerTache(Tache $ta){
            return $this->gtw->deleteTache($ta->ID);
        }

    }
