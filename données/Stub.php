<?php
class Stub
{
    static function creerListeVisible(): array{
        $liste1=new Liste(1,"Liste de courses", false);
        $liste2=new Liste(2,"Devoirs", false);
        
        $tache1=new Tache(1,"spaghetti",false);
        $tache2=new Tache(2,"sauce tomate",false);
        $tache3=new tache(3,"steak",false);
        $liste1->taches=array($tache1,$tache2,$tache3);
        $tache2->faite=true;

        $tache4=new Tache(4,"Finir le projet php",false);
        $tache5=new Tache(5,"Finir le tp en math",false);
        $tache6=new tache(6,"Avancer le projet tutoré",false);
        $liste2->taches=array($tache4,$tache5,$tache6);
        $tache4->faite=true;

        return array($liste1,$liste2);
    }
}