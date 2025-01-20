<?php

require_once realpath(__DIR__ . '/../../') . '\app\Models\PdfCourse.php';
require_once realpath(__DIR__ . '/../../') . '\app\Models\VideoCourse.php';

class CourseController{
    public function addCourse(){
                
        if (isset($_POST['add_cours'])) {
            $titre = htmlspecialchars(trim($_POST['titre']));
            $description = htmlspecialchars(trim($_POST['description']));
            $categorie_id = intval($_POST['categorie_id']); 
            $type = $_POST['type'];
          
            $url = filter_var($_POST['url'], FILTER_SANITIZE_URL); 
            $puto_interface = htmlspecialchars(trim($_POST['image']));
            $selected_tags = isset($_POST['selected_tags']) ? explode(',', $_POST['selected_tags']) : [];
            $cours = null;
            switch ($type) {
                case 'pdf':
                    $cours = new PdfCourse($titre, $description, $categorie_id, $_SESSION['user_id'], $type, $url, $puto_interface, $selected_tags);
                    break;
                case 'video':
                    $cours = new VideoCourse($titre, $description, $categorie_id, $_SESSION['user_id'], $type, $url, $puto_interface, $selected_tags);
                    break;
                default:
                    echo "Error";
                    exit();
            }
            

            if ($cours && $cours->create()) {
                header("location: ./course/add-cours.php");
                // header("Location: ../Views/teacher/course/add-cours.php");
                exit();
               
            } else {
                echo "error";
                // header("Location: ../Views/teacher/course/add-cours.php");
                exit();
            }
           
        }
    }
    public function show(){
        $cours = new PdfCourse();
       return $cours->show();
    }


    public function deleteCours() {
        if (isset($_GET['id']) && isset($_GET['type'])) {
            $id = $_GET['id'];
            $type = $_GET['type'];
    
            if (empty($id) || empty($type)) {
                echo "Error: Missing ID or type.";
                exit();
            }
    
            switch ($type) {
                case 'pdf':
                    $cours = new PdfCourse();
                    break;
                case 'video':
                    $cours = new VideoCourse();
                    break;
                default:
                    echo "Error: Invalid type.";
                    exit();
            }
    
            $cours->id = $id;
            if ($cours->delete()) {
                if ($_SESSION['user_role'] == 1 ){
                    header("Location: ../../admin/course.php"); 
                }
               
                elseif ( $_SESSION['user_role'] == 2 ){
                    header("Location: ../coures.php"); 
                }
                exit();
            } else {
                echo "Error deleting course.";
                exit();
            }
        } else {
            echo "Error: Missing parameters.";
            exit();
        }
    }
    public function updateCourse() {
        if (isset($_POST['update_cours'])) {
            $id = intval($_POST['id']);
            $titre = htmlspecialchars(trim($_POST['titre']));
            $description = htmlspecialchars(trim($_POST['description']));
            $categorie_id = intval($_POST['categorie_id']);
            
            $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
            $puto_interface = htmlspecialchars(trim($_POST['image']));
            $selected_tags = isset($_POST['selected_tags']) ? explode(',', $_POST['selected_tags']) : [];
            $cours = null;
            $cours = new PdfCourse($titre, $description, $categorie_id, $_SESSION['user_id'], $url, $puto_interface, $selected_tags);
            $cours->id = $id;
         
            if ($cours->update()) {
               
                header("Location: ../coures.php");
                exit();
            } else {
                echo "Error updating course.";
                exit();
            }
        }
    }
    public function getCoursById($id){
        $cours = new PdfCourse();
        $cours->id = $id;
        $courseData = $cours->find();
        return $courseData;
    }
    
    

}
// $CourseController= new CourseController();
// $CourseController->addCourse();
