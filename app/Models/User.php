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

        if($role==3){
            $estActif = true;
        }else{
            $estActif = false; 
        }

        $query = "INSERT INTO Utilisateur (nom, email, motDePasse, role_id, estActif) VALUES (:nom, :email, :motDePasse, :role, :estActif)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDePasse', $motDePasseHash);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':estActif', $estActif);

        return $stmt->execute(); 
    }

    public function login($email,$motDePasse){
        $conn = $this->db->connect();
        $query = "SELECT * FROM Utilisateur WHERE email = :email ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        
        if($stmt->rowCount()>0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($motDePasse,$user['motDePasse'])){
                return $user;
            } else{
                return false;
            }
        }
      return false;
    }
    
}
?>
