<?php

require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
require_once 'Course.php';  

class PdfCourse extends Course {
    private $tag_ids;
    protected $createur_id;
    public $id;
    public function __construct($titre = "", $description = "", $categorie_id = null, $createur_id = null, $type = "pdf", $url = "", $phto_interface = null, $tag_ids = [],) {
        parent::__construct($titre, $description, $categorie_id, $createur_id, $type, $url, $phto_interface);
        $this->tag_ids = $tag_ids; 
        $this->createur_id = $createur_id ;
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
                  url = :url, phto_interface = :phto_interface
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categorie_id', $this->categorie_id);
        $stmt->bindParam(':url', $this->url);
         if (is_array($this->phto_interface)) {
         $this->phto_interface = implode(',', $this->phto_interface); 
         }
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
    public function find() {
        $db = new Database();
        $conn = $db->connect();
        $sql = "SELECT Cours.*, GROUP_CONCAT(cours_tags.tag_id) AS tag_ids
                FROM Cours 
                LEFT JOIN cours_tags ON Cours.id = cours_tags.cours_id
                 WHERE Cours.id = :id
                GROUP BY Cours.id
               ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    


    public function delete() {
        $db = new Database();
        $conn = $db->connect();
        $query = "DELETE FROM Cours WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return true;
    }

    public function show($currentPage = 1, $itemsPerPage = 6) {
        $db = new Database();
        $conn = $db->connect();
    
        $offset = ($currentPage - 1) * $itemsPerPage;
    
        $query = "
            SELECT 
                Cours.id,Cours.type, Cours.titre, Cours.price, Cours.description, Cours.url, 
                Categorie.nom as Categorie_nom, Cours.phto_interface, Cours.estPublie,
                Categorie.id as idCategorie, utilisateur.nom as createur,
                GROUP_CONCAT(Tag.nom SEPARATOR ', ') AS tags
            FROM 
                Cours
            JOIN Categorie ON Cours.categorie_id = Categorie.id
            JOIN utilisateur ON utilisateur.id = Cours.createur_id
            JOIN Cours_Tags ON Cours.id = Cours_Tags.cours_id
            JOIN Tag ON Cours_Tags.tag_id = Tag.id
            GROUP BY 
                Cours.id
            LIMIT :itemsPerPage OFFSET :offset
        ";
    
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalItems() {
        $db = new Database();
        $conn = $db->connect();
    
        $query = "SELECT COUNT(*) as total FROM Cours";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function showContone() {
        $db = new Database();
        $conn = $db->connect();
        $query = "
        SELECT 
            Cours.id, Cours.type, Cours.titre, Cours.price, Cours.description, Cours.url, 
            Categorie.nom as Categorie_nom, Cours.phto_interface, Cours.estPublie,
            Categorie.id as idCategorie, utilisateur.nom as createur,
            GROUP_CONCAT(Tag.nom SEPARATOR ', ') AS tags
        FROM 
            Cours
        JOIN Categorie ON Cours.categorie_id = Categorie.id
        JOIN utilisateur ON utilisateur.id = Cours.createur_id
        JOIN Cours_Tags ON Cours.id = Cours_Tags.cours_id
        JOIN Tag ON Cours_Tags.tag_id = Tag.id
        WHERE  Cours.id = :id
        GROUP BY 
            Cours.id
       
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $this->id);
    $stmt->execute();
     $course=$stmt->fetch(PDO::FETCH_ASSOC);

    echo '
                <div class="Pdf">
                <iframe class="iframePdf" src="' . htmlspecialchars($course["url"]) . '"></iframe>
                </div>
    ';
    } 

    }













?>