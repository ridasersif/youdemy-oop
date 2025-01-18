<?php
session_start();
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
                header("Location: ../Views/teacher/course/add-cours.php?status=success");
                exit();
               
            } else {
                echo "dfghjkl";
                header("Location: ../Views/teacher/course/add-cours.php?status=error");
                exit();
            }
           
        }
    }
    public function show(){
        $cours = new PdfCourse();
       return $cours->show();
    }

}
$CourseController= new CourseController();
$CourseController->addCourse();
