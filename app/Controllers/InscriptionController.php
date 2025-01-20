<?php
require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
require_once realpath(__DIR__ . '/../../') . '\app\Models\Etudiant.php';

$database = new Database();
$pdo = $database->connect();

if (isset($_GET['cours_id']) && isset($_GET['student_id'])) {
    $cours_id = intval($_GET['cours_id']);
    $student_id = intval($_GET['student_id']); 

  
    $etudiant = new Etudiant($pdo); 
    $result = $etudiant->inscrire($student_id, $cours_id);
    if ($result) {
        header("Location: ../../index.php");
    } else {
     
        header("Location: /youdemy-oop/public/courses.php?message=error");
    }
    exit;
}
