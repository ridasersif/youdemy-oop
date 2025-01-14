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
            if ($userModel->checkEmailExists($email)) {
                $_SESSION['error_message'] = "Cet email est déjà utilisé.";
                header('Location: ../Views/auth/register.php'); 
                exit();
            }
            if ($userModel->createUser($nom, $email, $motDePasse, $role)) {
                echo "Inscription réussie.";
                header('Location: ../../public/index.php');
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
                $_SESSION['user']=[
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                header('Location: ../../public/index.php');
                exit();
            }else{
               $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
               header('Location: ../Views/auth/login.php');
               exit();
            }

        }
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController();
    $authController->register();
    $authController->login();
}
?>

















// require_once '../../config/database.php';
// // require_once '../Models/Utilisateur.php';

// class AuthController {
    
//     public function register() {
//         if (isset($_POST['submit'])) {
//             $nom = $_POST['nom'];
//             $email = $_POST['email'];
//             $motDePasse = $_POST['motDePasse'];
//             $role = $_POST['role'];

//             if (empty($nom) || empty($email) || empty($motDePasse) || empty($role)) {
//                 die("Tous les champs doivent être remplis.");
//             }

//             $db = new Database();
//             $conn = $db->connect();
//             $query = "SELECT * FROM Utilisateur WHERE email = :email";
//             $stmt = $conn->prepare($query);
//             $stmt->bindParam(':email', $email);
//             $stmt->execute();

//             if ($stmt->rowCount() > 0) {
//                 die("Cet email est déjà utilisé.");
//             }

//             $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);

//             $query = "INSERT INTO Utilisateur (nom, email, motDePasse, role_id) VALUES (:nom, :email, :motDePasse, :role)";
//             $stmt = $conn->prepare($query);
//             $stmt->bindParam(':nom', $nom);
//             $stmt->bindParam(':email', $email);
//             $stmt->bindParam(':motDePasse', $motDePasseHash);
//             $stmt->bindParam(':role', $role);

//             if ($stmt->execute()) {
//                 echo "Inscription réussie.";
//                 header('Location: login.php');
//                 exit();
//             } else {
//                 die("Erreur lors de l'inscription.");
//             }
//         }
//     }
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $authController = new AuthController();
//     $authController->register();
// }
