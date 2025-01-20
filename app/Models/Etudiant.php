<?php
class Etudiant {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function inscrire($student_id, $cours_id) {
        try {
          
            $query = "SELECT * FROM Inscription WHERE etudiant_id = :student_id AND cours_id = :cours_id AND deleted_at IS NULL";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':student_id' => $student_id,
                ':cours_id' => $cours_id
            ]);
            if ($stmt->rowCount() > 0) {
                return false; 
            }

          
            $query = "INSERT INTO Inscription (etudiant_id, cours_id) VALUES (:student_id, :cours_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':student_id' => $student_id,
                ':cours_id' => $cours_id
            ]);
            return true; 
        } catch (PDOException $e) {
       
            return false;
        }
    }
}
