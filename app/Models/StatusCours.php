<?php
require_once realpath(__DIR__ . '/../../') . '/config/Database.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $db = new Database();
    $conn = $db->connect();
    
    $action = $_GET['action'];
    $id = (int) $_GET['id'];
   
    if ($action === 'publie') {
        $query = "UPDATE Cours SET estPublie = true WHERE id = :id";
    } else if ($action === 'Dpublie') {
        $query = "UPDATE Cours SET estPublie = false WHERE id = :id";
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
       
        header("location: ../Views/admin/course.php");
    }
}
