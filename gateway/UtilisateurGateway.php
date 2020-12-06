<?php
	require_once('Gateway.php');
	
    class UtilisateurGateway extends Gateway {
		
        function __construct(Connection $con){
			parent::__construct($con);
		}

		public function find(string $nom, string $mdp ){
			$query = "SELECT * FROM utilisateur WHERE nom=:nom AND mdp=:mdp ";
			$this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
															':mdp' => array($mdp, PDO::PARAM_STR)));
			$rows = $this->con->getResults();
			if(empty($rows)) return NULL; // Si le couple mdp/utilisateurs n'existe pas
			return $rows[0]['ID'];
		}

		public function insert(string $nom, string $mdp): int{
			$query = "INSERT INTO utilisateur (nom, mdp) VALUES(:nom,:mdp)";
			$this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
															 ':mdp' => array($mdp, PDO::PARAM_STR)));
			return $this->con->lastInsertId();
		}

		public function update(int $id, string $nvNom, string $nvMdp){
			$query = "UPDATE utilisateur SET nom=:nom, mdp=:mdp WHERE ID=:id";
			$this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
															':mdp' => array($nvMdp, PDO::PARAM_STR),
															':id' => array($id, PDO::PARAM_INT)));
		}

		public function delete(int $id){
			$query = "DELETE FROM utilisateur WHERE ID=:id";
			$this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
		}


		// PAS UTILE POUR LE MOMENT :
		public function findAll(): array{
			$query = "SELECT * FROM utilisateur";
			$this->con->executeQuery($query);
			$utilisateurs = array();
			foreach ($this->con->getResults() as $row)
				array_push($utilisateurs, new Utilisateur($row['ID'], $row['nom'], $row['mdp']));
			return $utilisateurs;
		}
		public function findByID(int $id){
			$query = "SELECT * FROM utilisateur WHERE ID=:id";
			$this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
															
			$rows = $this->con->getResults();
			if(empty($rows)) return NULL; // Si le couple mdp/utilisateurs n'existe pas
			return $rows[0];
		}


    }


