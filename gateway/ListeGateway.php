<?php
	require('Gateway.php');
    require('../model/Liste.php');
    
    class ListeGateway extends Gateway {
            
            function __construct(Connection $con){
                parent::__construct($con);
            }


            public function findAllPublique(): array{                
                $query = "SELECT * FROM ListePublique";
                $this->con->executeQuery($query);
                $listes = array();
                
                foreach ($this->con->getResults() as $row)
                    array_push($listes, new Liste($row['ID'], $row['nom'], false));
               return $listes;
            }


            public function findAllFromUtilisateur(Utilisateur $util): array{                
                $query = "SELECT * FROM ListePrivee WHERE IDUtilisateur=:id";
                $this->con->executeQuery($query, array(':id' => array($util->ID, PDO::PARAM_INT)));
                $listes = array();
                
                foreach ($this->con->getResults() as $row)
                    array_push($listes, new Liste($row['ID'], $row['nom'], true));
               return $listes;
            }


            public function updateNom(Liste $liste, string $nvNom): bool{
                if($liste->privee) $table = "ListePrivee";
                else $table = "ListePublique";

                $query = "UPDATE $table SET nom=:nom WHERE ID=:id";
                $retour = $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                                ':id' => array($liste->ID, PDO::PARAM_INT)));
                return $retour;
            }

    }