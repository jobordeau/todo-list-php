<?php
	require('Gateway.php');
    
    class ListeGateway extends Gateway {
            
            function __construct(Connection $con){
                parent::__construct($con);
            }            

            public function findAllPublique(): array{                
                $query = "SELECT * FROM ListePublique";
                $this->con->executeQuery($query);
                return $this->con->getResults();
            }

            public function findAllFromUtilisateur(int $id): array{                
                $query = "SELECT * FROM ListePrivee WHERE IDUtilisateur=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));                
                return $this->con->getResults();
            }

            public function insertListePrivee(string $nom, int $id): int{
                $query = "INSERT INTO ListePrivee (nom, IDUtilisateur) VALUES(:nom,:id)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
                                                       ':id' => array($id, PDO::PARAM_INT)));
                return $this->con->lastInsertId();
            }

            public function insertListePublique(string $nom): int{
                $query = "INSERT INTO ListePublique (nom) VALUES(:nom)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_INT))); 
                return $this->con->lastInsertId();
            }


            public function updateListePrive(int $id, string $nvNom){
                $query = "UPDATE ListePrivee SET nom=:nom WHERE ID=:id";
                $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                                ':id' => array($id, PDO::PARAM_INT)));
            }

            public function updateListePublique(int $id, string $nvNom){
                $query = "UPDATE ListePublique SET nom=:nom WHERE ID=:id";
                $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                                ':id' => array($id, PDO::PARAM_INT)));
            }

            public function deleteListePrivee(int $id){
                $query = "DELETE FROM ListePrivee WHERE ID=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
            }

            public function deleteListePublique(int $id){
                $query = "DELETE FROM ListePublique WHERE ID=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
            }
    


    }