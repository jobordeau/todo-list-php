<?php
	require_once('Gateway.php');

    
    class TacheGateway extends Gateway {
            
            function __construct(Connection $con){
                parent::__construct($con);
            }


            public function findAllFromListe(int $id): array{
                $query = "SELECT * FROM Tache WHERE IDListe=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
                return $this->con->getResults();
            }

            public function insertTache(string $nom, int $id): int{
                $query = "INSERT INTO Tache (nom, faite, IDListe) VALUES(:nom, :faite, :id)";
                $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
                                                       ':faite' => array(false, PDO::PARAM_BOOL),
                                                       ':id' => array($id, PDO::PARAM_INT)));
                return $this->con->lastInsertId();
            }

            public function updateTache(int $id, string $nvNom){
                $query = "UPDATE Tache SET nom=:nom WHERE ID=:id";
                $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
                                                       ':id' => array($id, PDO::PARAM_INT)));
            }

            public function updateTacheFaite(int $id, bool $faite){
                $query = "UPDATE Tache SET faite=:faite WHERE ID=:id";
                $this->con->executeQuery($query, array(':faite' => array($faite, PDO::PARAM_BOOL),
                                                        ':id' => array($id, PDO::PARAM_INT)));
            }

            public function deleteTache(int $id){
                $query = "DELETE FROM Tache WHERE ID=:id";
                $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
            }

    }