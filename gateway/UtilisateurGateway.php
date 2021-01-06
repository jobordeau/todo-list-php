<?php
	
    class UtilisateurGateway extends Gateway {
		
        function __construct(Connection $con){
			parent::__construct($con);
		}

		public function find(string $nom){
			$query = "SELECT * FROM utilisateur WHERE nom=:nom";
			$this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR)));
			$rows = $this->con->getResults();
			if(empty($rows)) return NULL; // Si l'utilisateurs n'existe pas
			return $rows[0];
		}

		public function insert(string $nom, string $mdp): int{
			$query = "INSERT INTO utilisateur (nom, mdp) VALUES(:nom,:mdp)";
			try{
				$this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
				':mdp' => array($mdp, PDO::PARAM_STR)));
			}catch (PDOException $e) {
				throw new Exception();
			}
			return $this->con->lastInsertId();
		}

		public function update(int $id, string $nvNom, string $nvMdp){
			$query = "UPDATE utilisateur SET nom=:nom, mdp=:mdp WHERE ID=:id";
			try{
				$this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
				':mdp' => array($nvMdp, PDO::PARAM_STR),
				':id' => array($id, PDO::PARAM_INT))); 
			}catch (PDOException $e) {
				throw new Exception();
			}
		}

		public function delete(int $id){
			$query = "DELETE FROM utilisateur WHERE ID=:id";
			try{
				$this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
			}catch (PDOException $e) {
				throw new Exception();
			}
		}


		// PAS UTILE POUR LE MOMENT :
		public function findAll(): array{
			$query = "SELECT * FROM utilisateur";
			try{
				$this->con->executeQuery($query);  
			}catch (PDOException $e) {
				throw new Exception();
			}
			$utilisateurs = array();
			foreach ($this->con->getResults() as $row)
				array_push($utilisateurs, new Utilisateur($row['ID'], $row['nom'], $row['mdp']));
			return $utilisateurs;
		}
		public function findByID(int $id){
			$query = "SELECT * FROM utilisateur WHERE ID=:id";
			try{
				$this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_STR)));
			}catch (PDOException $e) {
				throw new Exception();
			}											
			$rows = $this->con->getResults();
			if(empty($rows)) return NULL; // Si le couple mdp/utilisateurs n'existe pas
			return $rows[0];
		}


    }


