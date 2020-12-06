<?php
	require_once('Gateway.php');

    
    class TacheGateway extends Gateway {
            
            function __construct(Connection $con){
                parent::__construct($con);
            }


            public function findAllFromListePublique(int $id): array{
                $query = "SELECT * FROM TachePublique WHERE IDListe=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
                return $this->con->getResults();
            }

            public function findAllFromListePrivee(int $id): array{
                $query = "SELECT * FROM TachePrivee WHERE IDListe=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
                return $this->con->getResults();
            }

            public function insertTachePrivee(string $nom, int $id): int{
                $query = "INSERT INTO TachePrivee (nom, faite, IDListe) VALUES(:nom, :faite, :id)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
                                                       ':faite' => array(false, PDO::PARAM_BOOL),
                                                       ':id' => array($id, PDO::PARAM_INT)));
                return $this->con->lastInsertId();
            }

            public function insertTachePublique(string $nom, int $id): int{
                $query = "INSERT INTO TachePublique (nom, faite, IDListe) VALUES(:nom, :faite, :id)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
                                                       ':faite' => array(false, PDO::PARAM_BOOL),
                                                       ':id' => array($id, PDO::PARAM_INT)));
                return $this->con->lastInsertId();
            }

            public function updateTachePrivee(int $id, string $nvNom){
                $query = "UPDATE TachePrivee SET nom=:nom WHERE ID=:id";
                $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                                ':id' => array($id, PDO::PARAM_INT)));
            }

            public function updateTachePublique(Tache $tache, string $nvNom){
                $query = "UPDATE TachePublique SET nom=:nom WHERE ID=:id";
                $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                       ':id' => array($tache->ID, PDO::PARAM_INT)));
            }

            public function updateTachePriveeFaite(int $id, bool $faite){
                $query = "UPDATE TachePrivee SET faite=:faite WHERE ID=:id";
                $this->con->executeQuery($query, array(':faite' => array($faite, PDO::PARAM_BOOL),
                                                        ':id' => array($id, PDO::PARAM_INT)));
            }

            public function updateTachePubliqueFaite(int $id, bool $faite){
                $query = "UPDATE TachePublique SET faite=:faite WHERE ID=:id";
                $this->con->executeQuery($query, array(':faite' => array($faite, PDO::PARAM_BOOL),
                                                        ':id' => array($id, PDO::PARAM_INT)));
            }

            public function deleteTachePrivee(int $id){
                $query = "DELETE FROM TachePrivee WHERE ID=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
            }

            public function deleteTachePublique(int $id){
                $query = "DELETE FROM TachePublique WHERE ID=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
            }

    }