<?php
require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
class Tags{
    private $id;
    private $nom;

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setNom($nom){
        $this->nom=$nom;
    }
   
    public function __construct($id,$nom)
    {
        $this->id=$id;
        $this->nom=$nom;
    }

}




?>