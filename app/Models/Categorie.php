<?php
require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
class Categorie{
    private $id;
    private $nom;
    private $description;
    private $logo;

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getLogo(){
        return $this->logo;
    }
    public function setNom($nom){
        $this->nom=$nom;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setLogo($logo){
        $this->logo=$logo;
    }
    public function __construct($id,$nom,$description,$logo)
    {
        $this->id=$id;
        $this->nom=$nom;
        $this->description=$description;
        $this->logo=$logo;
    }

}




?>