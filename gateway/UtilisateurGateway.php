<?php
	require('Gateway.php');
	require('../model/Utilisateur.php');
	
    class UtilisateurGateway extends Gateway {
		
        function __construct(Connection $con){
			parent::__construct($con);
		}

		public function findAll(): array{
			$query = "SELECT * FROM utilisateur";
			$this->con->executeQuery($query);
			$utilisateurs = array();
			foreach ($this->con->getResults() as $row)
				array_push($utilisateurs, new Utilisateur($row['ID'], $row['nom'], $row['mdp']));
			return $utilisateurs;
		}

		public function find(string $nom, string $mdp ): Utilisateur{
			$query = "SELECT * FROM utilisateur WHERE nom=:nom AND mdp=:mdp ";
			$retour = $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
															':mdp' => array($mdp, PDO::PARAM_STR)));
			if($retour == false) return NULL; // Si le couple mdp/utilisateurs n'existe pas
			$row = $this->con->getResults()[0];
			return new Utilisateur($row['ID'], $row['nom'], $row['mdp']);
		}

		public function insert(int $id, string $nom, string $mdp): bool{
			$query = "INSERT INTO utilisateur VALUES(:id,:nom,:mdp)";
			$retour = $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT),
													':nom' => array($nom, PDO::PARAM_STR),
													':mdp' => array($mdp, PDO::PARAM_STR)));
			return $retour;
		}

		public function updateNom(int $id, string $nvNom): bool{
			$query = "UPDATE utilisateur SET nom=:nom WHERE ID=:id";
			$retour = $this->con->executeQuery($query, array(':nom' => array($nvNom, PDO::PARAM_STR),
															':id' => array($id, PDO::PARAM_INT)));
			return $retour;
		}
		
		public function updateMdp(int $id, string $nvMdp): bool{
			$query = "UPDATE utilisateur SET mdp=:mdp WHERE ID=:id";
			$retour = $this->con->executeQuery($query, array(':mdp' => array($nvMdp, PDO::PARAM_STR),
															':id' => array($id, PDO::PARAM_INT)));
			return $retour;
		}

    }


