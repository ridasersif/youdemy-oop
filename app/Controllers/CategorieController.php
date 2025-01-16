<?php
require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
require_once realpath(__DIR__ . '/../../') . '\app\Models\managCategorie.php';


class CategorieController {
    private $manager;

    public function __construct() {
        $this->manager = new ManagerCtegorie();
    }
    public function getAllCategories() {
        return $this->manager->getAllCatedorie();
    }
    public function addCategorie($nom, $description, $logo) {
        $categorie = new Categorie(null, $nom, $description, $logo);
        $this->manager->insertCtegorie($categorie);
    }
    public function updateCategorie($id, $nom, $description, $logo) {
        $categorie = new Categorie($id, $nom, $description, $logo);
        $this->manager->updateCategorie($categorie);
    }
    public function deleteCategorie($id) {
        $this->manager->delete($id);
    }
}



