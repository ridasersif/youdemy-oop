<?php
abstract class Course {
    protected $id;
    protected $titre;
    protected $description;
    protected $categorie_id;
    protected $createur_id;
    protected $type;
    protected $url;
    protected $phto_interface;
    protected $tag_id;
    protected $db;
    // protected $price;


    public function __construct($titre = "", $description = "", $categorie_id = null, $createur_id = null, $type = "", $url = "", $phto_interface = null,  $tag_id = null) {
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie_id = $categorie_id;
        $this->createur_id = $createur_id;
        $this->type = $type;
        $this->url = $url;
        $this->phto_interface = $phto_interface;
        $this->tag_id = $tag_id;
        // $this->price = $price;
        $this->db = new Database();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    // public function getprice() {
    //     return $this->price;
    // }

    // public function setprice($price) {
    //     $this->price = $price;
    // }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCategorieId() {
        return $this->categorie_id;
    }

    public function setCategorieId($categorie_id) {
        $this->categorie_id = $categorie_id;
    }

    public function getCreateurId() {
        return $this->createur_id;
    }

    public function setCreateurId($createur_id) {
        $this->createur_id = $createur_id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getPhtoInterface() {
        return $this->phto_interface;
    }

    public function setPhtoInterface($phto_interface) {
        $this->phto_interface = $phto_interface;
    }

    public function getTagId() {
        return $this->tag_id;
    }

    public function setTagId($tag_id) {
        $this->tag_id = $tag_id;
    }

    abstract public function create();

    abstract public function update();

    abstract public function delete();

    abstract public function show();

    abstract public function showContone();
}
?>
