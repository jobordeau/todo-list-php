<?php
class Liste
{
    private $ID;
    private $nom;
    private $privee;
    private $taches;


    public function __construct ($ID, $nom, $privee)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->privee=$privee;
    $this->taches=array();
    }

    public function __get($propriete){
        return $this->$propriete;
    }

    public function __set($propriete,$val){
        $this->$propriete=$val;
    }

    public function __toString(){
        $str="ID : $this->ID<br/>";
        $str=$str."Nom : $this->nom<br/>";
        if($this->privee)
            $str= $str."privée<br/>";
        else
            $str= $str."publique<br/>";
    return $str;
    }

}


