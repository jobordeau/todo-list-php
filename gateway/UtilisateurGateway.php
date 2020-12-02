<?php
	require('Gateway.php');
	require('../entites/Utilisateur.php');
	
    class UtilisateurGateway extends Gateway {
		
        function __construct(Connection $con){
			parent::__construct($con);
		}
	
		public function find(string $nom, string $mdp ): array {
			$query = "SELECT * FROM utilisateur WHERE nom=:nom AND mdp=:mdp ";
			$retour = $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
															':mdp' => array($mdp, PDO::PARAM_STR)));
			if($retour == false) return NULL; // Si le couple mdp/utilisateurs n'existe pas
			return $this->con->getResults()[0];
		}

		public function insert(string $nom, string $mdp): int{
			$query = "INSERT INTO utilisateur (nom, mdp) VALUES(:nom,:mdp)";
			$retour = $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
													':mdp' => array($mdp, PDO::PARAM_STR)));
			if(!$retour) return NULL; // Si l'utilisateur existe déjà

			// Sinon on retourne l'ID 							
			$query = "SELECT ID FROM utilisateur WHERE nom=:nom";
			$retour = $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR)));
			return $this->con->getResults()[0]['ID'];
		}

		public function update(int $id, string $nvNom, string $nvMdp): bool{
			$query = "UPDATE utilisateur SET nom=:nom AND mdp=:mdp WHERE ID=:id";
			$retour = $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
															':mdp' => array($nvMdp, PDO::PARAM_STR),
															':id' => array($id, PDO::PARAM_INT)));
			return $retour;
		}

		public function delete(int $id): bool{
			$query = "DELETE FROM utilisateur WHERE ID=:id";
			return $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
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


    }


