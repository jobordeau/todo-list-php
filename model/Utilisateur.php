<?php
require_once("Visiteur.php");
class Utilisateur extends Visiteur
{

    private $nom;
    private $psswd;

    public function __construct ($ID, $nom, $psswd)
    {
    parent::__construct($ID);
    $this->nom=$nom;
    $this->psswd=$psswd;
    }

    public function __toString(){
        $class=get_class($this);
        $str="";
        $str="$str Class : $class<br/>";
        $str="$str ID : $this->ID<br/>";
        $str="$str Nom : $this->nom<br/>";
        $str="Mot de passe : $this->psswd<br/>";
    return $str;
    }

    public function __get($propriete){
        return $this->$propriete;
    }

    public function __set($propriete,$val){
        $this->$propriete=$val;
    }
}

//temporaire c'est juste pour tester
$test=new Utilisateur(58,'jojo', '12345');
echo $test;
