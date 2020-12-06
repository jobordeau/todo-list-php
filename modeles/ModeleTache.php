<?php
    require('../gateway/Connection.php');
    require('../config/config.php');
    require('../entites/Tache.php');
    require('../entites/Liste.php');
    require('../gateway/TacheGateway.php');
    

    class ModeleTache {
        private $gtw;

        function __construct(){
            global $login, $mdp, $dsn;
            $this->gtw = new TacheGateway(new Connection($dsn, $login, $mdp));
        }

        public function creerTache(string $nom, bool $privee , int $idLi){
            if($privee){
                $id = $this->gtw->insertTachePrivee($nom, $idLi);
            }
            else {
                $id = $this->gtw->insertTachePublique($nom, $idLi);
            }
            return new Tache($id, $nom, $privee);
        }  

        public function trouverTacheListe(Liste $li){
            $taches = array();
            if($li->privee){
                $rows = $this->gtw->findAllFromListePrivee($li->ID);
            }
            else {
                $rows = $this->gtw->findAllFromListePublique($li->ID);
            }
            foreach ($rows as $row)
                array_push($taches, new Tache($row['ID'], $row['nom'], $li->privee ,$row['faite']));
           return $taches;
        }
     
        public function modifierTache(Tache $ta, string $nvNom){
            if($ta->privee){
                $this->gtw->updateTachePrivee($ta->ID, $nvNom);
            }
            else {
                $this->gtw->updateTachePublique($ta->ID, $nvNom);
            }
            $ta->nom = $nvNom;
        }
        
        public function modifierEtat(Tache $ta, bool $faite){
            if($ta->privee){
                $this->gtw->updateTachePriveeFaite($ta->ID, $faite);
            }
            else {
                $this->gtw->updateTachePubliqueFaite($ta->ID, $faite);
            }
            $ta->nom = $faite;
        }

        public function supprimerTache(Tache $ta){
            if($ta->privee){
                return $this->gtw->deleteTachePrivee($ta->ID);
            }
            return $this->gtw->deleteTachePublique($ta->ID);
        }

    }
