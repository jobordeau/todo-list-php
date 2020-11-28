<?php
class Visiteur
{
    protected $ID;


    public function __construct ($ID)
    {
    $this->ID=$ID;
    }

    public function __toString(){
        $class=get_class($this);
        $str="";
        $str="$str Class : $class<br/>";
        $str="$str ID : $this->ID<br/>";
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
$test=new Visiteur(56);
echo $test;
