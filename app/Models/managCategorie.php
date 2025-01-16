<?php
require_once realpath(__DIR__ . '/../../') . '\config\Database.php';

require_once __DIR__ . '/Categorie.php';

class ManagerCtegorie{
    public function insertCtegorie(Categorie $Categorie){
        $db = new Database();
        $conn = $db->connect();
        $stmt = $conn->prepare("INSERT INTO Categorie (nom, description, logo)
        VALUES (:nom, :description, :logo) ");

        $stmt->execute([
            ':nom'=>$Categorie->getNom(),
            ':description'=>$Categorie->getDescription(),
            ':logo'=>$Categorie->getLogo(),
        ]);
    }
    public function getAllCatedorie() {
        $db = new Database();
        $conn = $db->connect();
        $stmt = $conn->prepare("SELECT * FROM Categorie WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateCategorie(Categorie $Categorie)
    {
        $db = new Database();
        $conn = $db->connect();
        $stmt = $conn->prepare("UPDATE Categorie SET nom = :nom, description = :description, logo = :logo WHERE id = :id");
        $stmt->execute([
            ':id' => $Categorie->getId(),
            ':nom' => $Categorie->getNom(),
            ':description' => $Categorie->getDescription(),
            ':logo' => $Categorie->getLogo(),
        ]);
    }
    public function delete($id){
        $db = new Database();
        $conn = $db->connect();
        $stmt= $conn->prepare("UPDATE Categorie SET deleted_at = NOW() WHERE id = :id");
        $stmt->execute([
            ':id'=>$id
        ]);
    }
}

?>