<?php
	require_once('Gateway.php');
    
    class ListeGateway extends Gateway {
            
            function __construct(Connection $con){
                parent::__construct($con);
            }            

            public function findAllPublique(): array{                
                $query = "SELECT * FROM Liste WHERE IDUtilisateur is NULL";
                $this->con->executeQuery($query);
                return $this->con->getResults();
            }

            public function findAllFromUtilisateur(int $id): array{                
                $query = "SELECT * FROM Liste WHERE IDUtilisateur=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));                
                return $this->con->getResults();
            }

            public function insertListePrivee(string $nom, int $id): int{
                $query = "INSERT INTO Liste (nom, IDUtilisateur) VALUES(:nom,:id)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
                                                       ':id' => array($id, PDO::PARAM_INT)));
                return $this->con->lastInsertId();
            }

            public function insertListePublique(string $nom): int{
                $query = "INSERT INTO Liste (nom, IDUtilisateur) VALUES(:nom, NULL)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR))); 
                return $this->con->lastInsertId();
            }


            public function updateListe(int $id, string $nvNom){
                $query = "UPDATE Liste SET nom=:nom WHERE ID=:id";
                $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                        ':id' => array($id, PDO::PARAM_INT)));
            }

            public function deleteListe(int $id){
                $query = "DELETE FROM Liste WHERE ID=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
            }


    }