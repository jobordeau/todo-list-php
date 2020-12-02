<?php
	require('Gateway.php');
    require('../entites/Tache.php');
    require('../entites/Liste.php');

    
    class TacheGateway extends Gateway {
            
            function __construct(Connection $con){
                parent::__construct($con);
            }

            public function findAllFromListe(Liste $liste): array{
                $id = $liste->ID;
                
                if($liste->privee) $table = "TachePrivee";
                else $table = "TachePublique";
                
                $query = "SELECT * FROM $table WHERE IDListe=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
                $taches = array();
                
                foreach ($this->con->getResults() as $row)
                    array_push($taches, new Tache($row['ID'], $row['nom'], $row['faite'], $liste->privee));
               return $taches;
            }

            public function updateNom(Tache $tache, string $nvNom): bool{
                if($tache->privee) $table = "TachePrivee";
                else $table = "TachePublique";

                $query = "UPDATE $table SET nom=:nom WHERE ID=:id";
                $retour = $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                                ':id' => array($tache->ID, PDO::PARAM_INT)));
                return $retour;
            }

            public function updateFaite(Tache $tache, bool $faite): bool{
                if($tache->privee) $table = "TachePrivee";
                else $table = "TachePublique";

                $query = "UPDATE $table SET faite=:faite WHERE ID=:id";
                $retour = $this->con->executeQuery($query, array(':faite' => array($faite, PDO::PARAM_BOOL),
                                                                ':id' => array($tache->ID, PDO::PARAM_INT)));
                return $retour;
            }


    }