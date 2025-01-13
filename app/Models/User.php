<?php

require_once '../../config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function checkEmailExists($email) {
        $conn = $this->db->connect();
        $query = "SELECT * FROM Utilisateur WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0; 
    }
    
    public function createUser($nom, $email, $motDePasse, $role) {
        $conn = $this->db->connect();
        $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);

        $query = "INSERT INTO Utilisateur (nom, email, motDePasse, role_id) VALUES (:nom, :email, :motDePasse, :role)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDePasse', $motDePasseHash);
        $stmt->bindParam(':role', $role);

        return $stmt->execute(); 
    }
}
?>
