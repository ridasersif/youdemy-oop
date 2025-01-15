<?php

require_once 'User.php';
class Administrateur extends User {
    public function getAllUsers(){
        $conn = $this->db->connect();
        $query = "SELECT * FROM Utilisateur WHERE deleted_at IS NULL AND role_id=2 OR role_id=1"; 
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateUserStatus($userId, $status) {
        $conn = $this->db->connect();

        $query = "UPDATE Utilisateur SET estActif = :status WHERE id = :userId  "; 
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteUser($userId) {
        $conn = $this->db->connect();
        
        $query = "UPDATE Utilisateur SET deleted_at = NOW() WHERE id = :userId"; 
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
