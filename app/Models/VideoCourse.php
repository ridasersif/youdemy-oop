<?php

require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
require_once 'Course.php';  

class VideoCourse extends Course {
    private $tag_ids;
    protected $createur_id;

    public function __construct($titre = "", $description = "", $categorie_id = null, $createur_id = null, $type = "video", $url = "", $phto_interface = null, $tag_ids = []) {
        parent::__construct($titre, $description, $categorie_id, $createur_id, $type, $url, $phto_interface);
        $this->tag_ids = $tag_ids; 
        $this->createur_id = $createur_id ?? $_SESSION['user_id'];
    }


    public function create() {
        $db = new Database();
        $conn = $db->connect();
        $query = "INSERT INTO Cours (titre, description, categorie_id, createur_id, type, url, phto_interface)
                  VALUES (:titre, :description, :categorie_id, :createur_id, :type, :url, :phto_interface)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categorie_id', $this->categorie_id);
        $stmt->bindParam(':createur_id', $this->createur_id);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':phto_interface', $this->phto_interface);
        $stmt->execute();

       
        $cours_id = $conn->lastInsertId();

      
        foreach ($this->tag_ids as $tag_id) {
            $query = "INSERT INTO Cours_Tags (cours_id, tag_id) VALUES (:cours_id, :tag_id)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':cours_id', $cours_id);
            $stmt->bindParam(':tag_id', $tag_id);
            $stmt->execute();
        }

        return true;
    }

    
    public function update() {
        $db = new Database();
        $conn = $db->connect();
        $query = "UPDATE Cours SET titre = :titre, description = :description, categorie_id = :categorie_id,
                  type = :type, url = :url, puto_interface = :puto_interface
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categorie_id', $this->categorie_id);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':phto_interface', $this->phto_interface);
        $stmt->execute();

      
        $query = "DELETE FROM Cours_Tags WHERE cours_id = :cours_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->execute();

        
        foreach ($this->tag_ids as $tag_id) {
            $query = "INSERT INTO Cours_Tags (cours_id, tag_id) VALUES (:cours_id, :tag_id)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':cours_id', $this->id);
            $stmt->bindParam(':tag_id', $tag_id);
            $stmt->execute();
        }

        return true;
    }


    public function delete() {
        $db = new Database();
        $conn = $db->connect();
        $query = "UPDATE Cours SET deleted_at = NOW() WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return true;
    }

    public function show() {
        $db = new Database();
        $conn = $db->connect();
        $query = "SELECT * FROM Cours WHERE id = :id AND deleted_at IS NULL";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
}

?>
