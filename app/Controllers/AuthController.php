<?php
session_start();

require_once '../../config/database.php';
require_once '../Models/User.php'; 

class AuthController {

    public function register() {
        if (isset($_POST['creerCompt'])) {
        
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $motDePasse = $_POST['motDePasse'];
            $role = $_POST['role'];

            if (empty($nom) || empty($email) || empty($motDePasse) || empty($role)) {
                die("Tous les champs doivent être remplis.");
            }

           
            $userModel = new User();
            if (            $userModel->checkEmailExists($email)){
                $_SESSION['error_message'] = "Cet email est déjà utilisé.";
                header('Location: ../Views/auth/register.php'); 
                exit();
            }
             $user=$userModel->createUser($nom, $email, $motDePasse, $role);
            if ($user) {
                header('Location: ../Views/auth/login.php');
                exit();
            } else {
                die("Erreur lors de l'inscription.");
            }
        }
    }
    public function login(){
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $motDePasse = $_POST['motDePasse'];

            if(empty($email) || empty($motDePasse)){
                $_SESSION['error_message'] = "Tous les champs sont obligatoires.";
                header('location: ../Views/auth/login.php');
                exit();
            }

            $userModel = new User();
            $user = $userModel->login($email, $motDePasse);
            if($user){


                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role_id'];
                $_SESSION['user_estActif'] = $user['estActif'];
                header('Location: ../../index.php');
                exit();
            }else{
               $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
               header('Location: ../Views/auth/login.php');
               exit();
            }

        }
    }
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ../Views/auth/login.php');
        exit();
      
    }
 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController();
    $authController->register();
    $authController->login();

}
if(isset($_GET['logou'])){
    $authController = new AuthController();
    $authController->logout();
}
?>














